<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class products extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $tbl_name = "products";
    private $layout = "layouts.products.products";
    private $layout_add = "layouts.products.product_add";
    private $layout_edit = "layouts.products.product_edit";
    private $unique_name = "name";
    private $unique_id = "id";
    private $main_name = "product";
    private $route = "product";
    private $message = "Product";
    public function index()
    {
        session()->forget("data");
        session()->forget("error");
        $cats = DB::select(
            "SELECT
                products.id as id ,
                products.name as prod_name,
                products.description as prod_desc ,
                concentration as conc ,
                require_reciepnt as recp,
                products.created_at,
                medicine_categories.name as cat ,
                medicine_types.name as med_type
            FROM
                " . $this->tbl_name .
                " JOIN
                medicine_categories
            ON
                medicine_categories.id=products.category_id
            JOIN
                medicine_types
            ON
                medicine_types.id=products.med_type
            ORDER BY
                products.id
            DESC"
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
        return view($this->layout_add, ['cats' => DB::select("SELECT id , name FROM medicine_categories"), 'types' => DB::select("SELECT id , name FROM medicine_types")]);
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
            "name"         => "bail|required|regex:/^[a-z _0-9]+$/i|max:30|unique:" . $this->tbl_name . "," . $this->unique_name,
            "desc"         => "bail|required",
            "consntration" => "bail|required|numeric|min:0.1",
            "cat"          => "required",
            "type"         => "required",
        ], [
            "name.required"         => "name-required",
            "name.unique"           => "name-exists",
            "name.regex"            => "name-valid",
            "name.max"              => "name-big",
            "desc.required"         => "desc-required",
            "consntration.required" => "cons-required",
            "consntration.numeric"  => "cons-numeric",
            "consntration.min"      => "cons-min",
            "cat.required"          => "cat-required",
            "type.required"         => "type-required",
        ]);
        $cat = DB::selectOne("SELECT id FROM medicine_categories WHERE id=?", [$validated_data['cat']]) ? true : false;
        $type = DB::selectOne("SELECT id FROM medicine_types WHERE id=?", [$validated_data['type']]) ? true : false;
        if (!$cat || !$type) {
            session()->put([
                "data" => $request->all(),
                "error" => (!$cat ? 'cat' : 'type') . '-not-exists'
            ]);

            return redirect(route("add-" . $this->route));
        }

        DB::table($this->tbl_name)->insert([
            "name" => $validated_data['name'],
            "description" => $validated_data['desc'],
            "concentration" => $validated_data['consntration'],
            "require_reciepnt" => $request->input("require") ? '1' : '0',
            "med_type" => $validated_data['type'],
            "category_id" => $validated_data['cat']
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
            'cats' => DB::select("SELECT id , name FROM medicine_categories"),
            'types' => DB::select("SELECT id , name FROM medicine_types"),
            'prod' => DB::selectOne("SELECT id , name , category_id , med_type , concentration  as cons , description as `desc` , require_reciepnt as `require` FROM {$this->tbl_name} WHERE id=?", [$id])
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

        if (!DB::selectOne("SELECT id FROM {$this->tbl_name} WHERE id=?", [$id])) return redirect(route("products"));
        $validated_data = $request->validate([
            "name"         => "bail|required|regex:/^[a-z _0-9]+$/i|max:30|unique:{$this->tbl_name},{$this->unique_name},$id,{$this->unique_id}",
            "desc"         => "bail|required",
            "consntration" => "bail|required|numeric|min:0.1",
            "cat"          => "required",
            "type"         => "required",
        ], [
            "name.required"         => "name-required",
            "name.unique"           => "name-exists",
            "name.regex"            => "name-valid",
            "name.max"              => "name-big",
            "desc.required"         => "desc-required",
            "consntration.required" => "cons-required",
            "consntration.numeric"  => "cons-numeric",
            "consntration.min"      => "cons-min",
            "cat.required"          => "cat-required",
            "type.required"         => "type-required",
        ]);
        $cat = DB::selectOne("SELECT id FROM medicine_categories WHERE id=?", [$validated_data['cat']]) ? true : false;
        $type = DB::selectOne("SELECT id FROM medicine_types WHERE id=?", [$validated_data['type']]) ? true : false;
        if (!$cat || !$type) {
            session()->put([
                "data" => $request->all(),
                "error" => (!$cat ? 'cat' : 'type') . '-not-exists'
            ]);

            return redirect(route("edit-" . $this->route));
        }

        DB::update("UPDATE {$this->tbl_name} SET name=? , description=? , concentration=? , require_reciepnt=? , med_type=? , category_id=? WHERE id=?", [$validated_data['name'], $validated_data['desc'], $validated_data['consntration'], $request->input("require") == 'on' ? '1' : '0', $validated_data['type'], $validated_data['cat'], $id]);
        session()->flash("{$this->main_name}-updated", '1');
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
        $cat = DB::selectOne("SELECT {$this->unique_id} FROM {$this->tbl_name} WHERE {$this->unique_id} =?", [$id]);
        if ($cat) {
            DB::delete("DELETE FROM {$this->tbl_name} WHERE {$this->unique_id} =?", [$id]);
            session()->flash("{$this->main_name}-deleted", '1');
            DB::table("logs")->insert([
                "action" => "{$this->message} Has Been Deleted [ {$this->message} ID -> " . $id . " ]",
                "who" => session()->get('id') ? session()->get("id") : 1
            ]);
        }
        return redirect(route($this->route));
    }
}
