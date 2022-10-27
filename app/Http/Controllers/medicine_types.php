<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class medicine_types extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $tbl_name = "medicine_types";
    private $layout = "layouts.types.types";
    private $layout_add = "layouts.types.type_add";
    private $layout_edit = "layouts.types.type_edit";
    private $unique_name = "name";
    private $unique_id = "id";
    private $main_name = "type";
    private $route = "type";
    private $message = "Medicine Type";
    public function index()
    {
        $cats = DB::select("SELECT * FROM " . $this->tbl_name);
        return view($this->layout, [$this->tbl_name => $cats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->layout_add);
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
            "name" => "required|regex:/^[a-z _]+$/i|max:30|unique:" . $this->tbl_name . "," . $this->unique_name
        ], [
            "name.required" => "name-required",
            "name.unique" => "name-exists",
            "name.regex" => "name-valid",
            "name.max" => "name-big",
        ]);
        DB::table($this->tbl_name)->insert([
            "name" => $validated_data['name']
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
        $cat = DB::selectOne("SELECT " . $this->unique_id . ",name FROM " . $this->tbl_name . " WHERE " . $this->unique_id . " =?", [$id]);
        if ($cat != NULL) {
            return view($this->layout_edit, [$this->tbl_name => $cat]);
        } else return redirect(route($this->route));
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
        $validated_data = $request->validate(
            [
                "name" => "required|max:20|regex:/^[a-z _]+$/i|unique:{$this->tbl_name},{$this->unique_name},$id,{$this->unique_id}"
            ],
            [
                "name.required" => "name-required",
                "name.regex" => "name-valid",
                "name.max" => "name-big",
                "name.unique" => "name-exists"
            ]
        );
        DB::insert("UPDATE {$this->tbl_name} SET name=? , updated_at =?  WHERE id =?", [$validated_data['name'], date("Y-m-d h:i:s"), $id]);
        session()->flash("{$this->main_name}-updated", '1');
        DB::table("logs")->insert([
            "action" => "{$this->message} Info Has Been Updated [ {$this->message} ID -> " . $id . " ]",
            "who" => session()->get('id') ? session()->get("id") : 1
        ]);
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
