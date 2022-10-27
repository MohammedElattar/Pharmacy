<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Partners extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = DB::select("SELECT partner_id as id , name , created_at FROM partners");
        return view("layouts.partners", ['partners' => $partners]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("layouts.add_partner");
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
            "name" => "required|regex:/^[a-z _]+$/i|max:30|unique:partners,name"
        ], [
            "name.required" => "name-required",
            "name.unique" => "name-exists",
            "name.regex" => "name-valid",
            "name.max" => "name-big",
        ]);
        DB::table("partners")->insert(["name" => $validated_data['name']]);
        session()->flash("partner-added", '1');
        return redirect(route("partners"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $partner = DB::selectOne("SELECT name,partner_id FROM partners WHERE partner_id =?", [$id]);
        if ($partner != NULL) {
            return view("layouts.edit_partner", ['partner' => $partner]);
        } else return redirect(route("partners"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
                "name" => "required|max:20|regex:/^[a-z _]+$/i|unique:partners,name, " . $id . " ,partner_id",
            ],
            [
                "name.required" => "name-required",
                "name.regex" => "name-valid",
                "name.max" => "name-big",
            ]
        );
        DB::insert("UPDATE partners SET name=? , updated_at =?  WHERE partner_id =?", [$validated_data['name'], date("Y-m-d h:i:s"), $id]);
        session()->flash("partner-updated", '1');
        DB::table("logs")->insert([
            "action" => "Partner Info Has Been Updated [ parter ID -> " . $id . " ]",
            "who" => session()->get('id') ? session()->get("id") : 1
        ]);
        return redirect(route("partners"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = DB::selectOne("SELECT partner_id FROM partners WHERE partner_id =?", [$id]);
        if ($user) {
            DB::delete("DELETE FROM partners WHERE partner_id =?", [$id]);
            session()->flash("partner-deleted", '1');
            DB::table("logs")->insert([
                "action" => "Partner Has Been Deleted [ parter ID -> " . $id . " ]",
                "who" => session()->get('id') ? session()->get("id") : 1
            ]);
        }
        return redirect(route("partners"));
    }
}
