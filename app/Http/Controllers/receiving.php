<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class receiving extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $tbl_name = "receiving";
    private $layout = "layouts.receiving.recieve";
    private $layout_add = "layouts.receiving.add_recieve";
    private $layout_edit = "layouts.receiving.edit_recieve";
    private $main_name = "receiving";
    private $route = "receiving";
    private $message = "Receive";
    public function index()
    {
        $cats = DB::select(
            "SELECT
                {$this->tbl_name}.id as id ,
                partners.name as supp_name,
                products.name as prod_name,
                products.qty as qty,
                products.price as price,
                products.exp as exp,
                {$this->tbl_name}.created_at
            FROM
                {$this->tbl_name}
            JOIN
                partners
            ON
                partners.partner_id={$this->tbl_name}.supplier
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
            'suppliers' => DB::select("SELECT partner_id as id , name FROM partners"),
            'products' => DB::select("SELECT id , name FROM products")
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
            "supplier"         => "required",
            "qty"       => "required|numeric|min:1",
            "price" => "required|numeric|min:0.1",
            'exp' => 'required|date'
        ], [
            "product.required"   => "prod-required",
            "supplier.required"   => "supp-required",
            "price.required"      => "price-required",
            "price.numeric"       => "price-num",
            "price.min"           => "price-min",
            "qty.required"        => "qty-required",
            "qty.numeric"         => "qty-num",
            "qty.min"             => "qty-min",
            'exp.required' => 'exp-required',
        ]);
        $supp = DB::selectOne("SELECT partner_id FROM partners WHERE partner_id=?", [$validated_data['supplier']]) ? true : false;
        $prod = DB::selectOne("SELECT id FROM products WHERE id=?", [$validated_data['product']]) ? true : false;
        $conn = false;
        if (!$supp || !$prod || $validated_data['exp'] <= date("Y-m-d")) {
            session()->put('data', $request->all());
            session()->put('error', !$prod ? 'prod' : (!$supp ? 'supp' : 'exp'));
            $conn = true;
        }
        if ($conn) {
            return redirect(route("add-" . $this->route));
            die;
        }
        DB::table($this->tbl_name)->insert([
            'supplier' => $validated_data['supplier'],
            'details' => json_encode([
                'qty' => $validated_data['qty'],
                'price' => $validated_data['price'],
                'total_price' => $validated_data['qty'] * $validated_data['price'],
                'exp' => $validated_data['exp']
            ]),
            'product' => $validated_data['product']

        ]);
        DB::update("UPDATE products SET qty=? , price =? , `exp`=? WHERE id =?", [$validated_data['qty'], $validated_data['price'], $validated_data['exp'], $validated_data['product']]);
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
            'suppliers' => DB::select("SELECT partner_id as id , name FROM partners"),
            'products' => DB::select("SELECT id , name FROM products"),
            'prod_info' => DB::selectOne(
                "SELECT
                    receiving.id as id,
                    product ,
                    supplier ,
                    products.qty as qty ,
                    products.price as price ,
                    products.exp as `exp`
                FROM
                    receiving
                JOIN
                    products
                ON
                    products.id = receiving.product
            "
            )
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

        if (!DB::selectOne("SELECT id FROM {$this->tbl_name} WHERE id=?", [$id])) return redirect(route($this->route));
        $validated_data = $request->validate([
            "product"          => "required",
            "supplier"         => "required",
            "qty"       => "required|numeric|min:1",
            "price" => "required|numeric|min:0.1",
            'exp' => 'required|date'
        ], [
            "product.required"   => "prod-required",
            "supplier.required"   => "supp-required",
            "price.required"      => "price-required",
            "price.numeric"       => "price-num",
            "price.min"           => "price-min",
            "qty.required"        => "qty-required",
            "qty.numeric"         => "qty-num",
            "qty.min"             => "qty-min",
            'exp.required' => 'exp-required',
        ]);
        $supp = DB::selectOne("SELECT partner_id FROM partners WHERE partner_id=?", [$validated_data['supplier']]) ? true : false;
        $prod = DB::selectOne("SELECT id FROM products WHERE id=?", [$validated_data['product']]) ? true : false;
        $conn = false;
        if (!$supp || !$prod || $validated_data['exp'] <= date("Y-m-d")) {
            session()->put('data', $request->all());
            session()->put('error', !$prod ? 'prod' : (!$supp ? 'supp' : 'exp'));
            $conn = true;
        }
        if ($conn) {
            return redirect(route("edit-" . $this->route, ['id' => $id]));
            die;
        }
        DB::table($this->tbl_name)->where('id', $id)->update([
            'supplier' => $validated_data['supplier'],
            'details' => json_encode([
                'qty' => $validated_data['qty'],
                'price' => $validated_data['price'],
                'total_price' => $validated_data['qty'] * $validated_data['price'],
                'exp' => $validated_data['exp']
            ]),
            'product' => $validated_data['product']
        ]);
        DB::table('products')->where('id', $validated_data['product'])->update([
            'qty' => $validated_data['qty'],
            'price' => $validated_data['price'],
            'exp' => $validated_data['exp'],
            'updated_at' => date("Y-m-d h:i:s")
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
