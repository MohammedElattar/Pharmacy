<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class User extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return login view

        return view("login");
    }

    public function auth(Request $req)
    {
        $validate = $req->validate([
            "email" => "required|email",
            "password" => "required"
        ], [
            "email" => [
                'required' => 'empty-email',
                'email' => "valid-email",
            ],
            "password" => "empty-password"
        ]);
        $data = DB::selectOne("SELECT id , name FROM users WHERE email =? AND password =?", [$validate["email"], sha1($validate['password'])]);
        if ($data != NULL) {
            session()->put(['loggedIn' => 1, "id" => $data->id, "name" => $data->name, "email" => $validate['email']]);
            return redirect("/");
        } else {
            session()->flash("not-exists", '1');
            return redirect("/login");
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
