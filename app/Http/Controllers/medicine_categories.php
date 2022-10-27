<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class medicine_categories extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = DB::select("SELECT * FROM medicine_categories");
        return view("layouts.medicine_categories.medicine_categories", ['cats' => $cats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("layouts.medicine_categories.medicine_categories_add");
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
            "name" => "required|regex:/^[a-z _]+$/i|max:30|unique:medicine_categories,name"
        ], [
            "name.required" => "name-required",
            "name.unique" => "name-exists",
            "name.regex" => "name-valid",
            "name.max" => "name-big",
        ]);
        DB::table("medicine_categories")->insert([
            "name" => $validated_data['name']
        ]);
        session()->flash("categories-added", '1');
        return redirect(route("medicine_categories"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat = DB::selectOne("SELECT id,name FROM medicine_categories WHERE id =?", [$id]);
        if ($cat != NULL) {
            return view("layouts.medicine_categories.medicine_categories_edit", ['cat' => $cat]);
        } else return redirect(route("medicine_categories"));
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
                "name" => "required|max:20|regex:/^[a-z _]+$/i|unique:medicine_categories,name, " . $id . " ,id",
            ],
            [
                "name.required" => "name-required",
                "name.regex" => "name-valid",
                "name.max" => "name-big",
                "name.unique" => "name-exists"
            ]
        );
        DB::insert("UPDATE medicine_categories SET name=? , updated_at =?  WHERE id =?", [$validated_data['name'], date("Y-m-d h:i:s"), $id]);
        session()->flash("categories-updated", '1');
        DB::table("logs")->insert([
            "action" => "Category Info Has Been Updated [ Category ID -> " . $id . " ]",
            "who" => session()->get('id') ? session()->get("id") : 1
        ]);
        return redirect(route("medicine_categories"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = DB::selectOne("SELECT id FROM medicine_categories WHERE id =?", [$id]);
        if ($cat) {
            DB::delete("DELETE FROM medicine_categories WHERE id =?", [$id]);
            session()->flash("categories-deleted", '1');
            DB::table("logs")->insert([
                "action" => "Category Has Been Deleted [ Category ID -> " . $id . " ]",
                "who" => session()->get('id') ? session()->get("id") : 1
            ]);
        }
        return redirect(route("medicine_categories"));
    }
}
