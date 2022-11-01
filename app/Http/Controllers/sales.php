<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class sales extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $tbl_name = "sales";
    private $layout = "layouts.sales.sale";
    private $layout_add = "layouts.sales.add_sale";
    private $layout_edit = "layouts.sales.edit_sale";
    private $main_name = "sale";
    private $route = "sale";
    private $message = "Sale";
    public function index()
    {
        $cats = DB::select(
            "SELECT
                {$this->tbl_name}.id as id ,
                {$this->tbl_name}.details,
                products.name as prod_name,
                {$this->tbl_name}.created_at
            FROM
                {$this->tbl_name}
            JOIN
                products
            ON
                products.id={$this->tbl_name}.product
            "
        );
        return view($this->layout, [$this->tbl_name => $cats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->layout_add, [
            'customers' => DB::select("SELECT id , name FROM customers"),
            'products' => DB::select("SELECT id , name FROM products WHERE `exp` > ?", [date("Y-m-d H:i:s")])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            "product"          => "required",
            "qty"       => "required|numeric|min:1",
            "price_val" => "required|numeric|min:0.1",
        ], [
            "product.required"   => "prod-required",
            "price_val.required"      => "price-required",
            "price_val.numeric"       => "price-num",
            "price_val.min"           => "price-min",
            "qty.required"        => "qty-required",
            "qty.numeric"         => "qty-num",
            "qty.min"             => "qty-min",
            'exp.required' => 'exp-required',
        ]);
        $prod = DB::selectOne("SELECT id,qty,price FROM products WHERE id=? AND `exp` > ?", [$validated_data['product'], date("Y-m-d H:i:s")]);
        $conn = false;
        if (!$prod || $prod->qty < $validated_data['qty']  || $validated_data['price_val'] != $prod->price) {
            session()->put('data', $validated_data);
            session()->put('error', !$prod ? 'prod' : ($prod->qty < $validated_data['qty'] ? 'qty' : 'price'));
            $conn = true;
        }
        if ($conn) {
            return redirect(route("add-" . $this->route));
            die;
        }
        DB::table($this->tbl_name)->insert([
            'details' => json_encode([
                'qty' => $validated_data['qty'],
                'price' => $validated_data['price_val']
            ]),
            'product' => $validated_data['product']

        ]);
        DB::table("products")->where("id", $validated_data['product'])->update([
            'qty' => $prod->qty - $validated_data['qty'],
            'price' => $prod->price
        ]);
        session()->flash("{$this->main_name}-added", '1');
        return redirect(route($this->route));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!DB::selectOne("SELECT id FROM {$this->tbl_name} WHERE id=?", [$id])) return redirect(route($this->route));
        return view($this->layout_edit, [
            'customers' => DB::select("SELECT id , name FROM customers"),
            'products' => DB::select("SELECT id , name FROM products WHERE `exp` > ?", [date("Y-m-d H:i:s")]),
            'sale_info' => DB::table($this->tbl_name)->where("id", $id)->select(['id', 'details', 'product'])->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $sale_info = DB::selectOne("SELECT details FROM {$this->tbl_name} WHERE id=?", [$id]);
        if (!$sale_info) return redirect(route($this->route));
        $sale_info = json_decode($sale_info->details);
        $validated_data = $request->validate([
            "product"          => "required",
            "qty"       => "required|numeric|min:1",
            "price_val" => "required|numeric|min:0.1",
        ], [
            "product.required"   => "prod-required",
            "price_val.required"      => "price-required",
            "price_val.numeric"       => "price-num",
            "price_val.min"           => "price-min",
            "qty.required"        => "qty-required",
            "qty.numeric"         => "qty-num",
            "qty.min"             => "qty-min",
            'exp.required' => 'exp-required',
        ]);
        $prod = DB::selectOne("SELECT id,qty,price FROM products WHERE id=? AND `exp` > ?", [$validated_data['product'], date("Y-m-d H:i:s")]);
        $conn = false;
        if (!$prod || ($prod->qty + $sale_info->qty) < $validated_data['qty']  || $validated_data['price_val'] != $prod->price) {
            session()->put('data', $validated_data);
            session()->put('error', !$prod ? 'prod' : ($prod->qty < $validated_data['qty'] ? 'qty' : 'price'));
            $conn = true;
        }
        if ($conn) {
            return redirect(route("edit-" . $this->route, ['id' => $id]));
            die;
        }
        DB::table($this->tbl_name)->where('id', $id)->update([
            'details' => json_encode([
                'qty' => $validated_data['qty'],
                'price' => $validated_data['price_val']
            ]),
            'product' => $validated_data['product']

        ]);
        DB::table("products")->where("id", $validated_data['product'])->where('exp', '>', date("Y-m-d H:i:s"))->update([
            'qty' => ($prod->qty + $sale_info->qty) - $validated_data['qty'],
            'price' => $prod->price
        ]);
        session()->flash("{$this->main_name}-edited", '1');
        return redirect(route($this->route));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = DB::selectOne("SELECT id FROM {$this->tbl_name} WHERE id =?", [$id]);
        if ($cat) {
            DB::delete("DELETE FROM {$this->tbl_name} WHERE id =?", [$id]);
            session()->flash("{$this->main_name}-deleted", '1');
            DB::table("logs")->insert([
                "action" => "{$this->message} Has Been Deleted [ {$this->message} ID -> " . $id . " ]",
                "who" => session()->get('id') ? session()->get("id") : 1
            ]);
        }
        return redirect(route($this->route));
    }
}
