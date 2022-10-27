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
        $users = DB::select("SELECT * FROM users" . (session()->has("id") ? " WHERE id != ?" : ""), session()->has("id") ? [session()->get("id")] : []);
        return view("layouts.users", ['users_data' => $users]);
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
        return view("layouts.add_user");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate(
            [
                "name" => "required|max:20|regex:/^[a-z _]+$/i",
                "email" => "required|email|unique:users,email",
                'password' => "required|between:8,20",
                "role" => 'digits_between:0,2'
            ],
            [
                "name.required" => "name-required",
                "name.regex" => "name-valid",
                "name.max" => "name-big",
                "email.required" => "email-required",
                "email.email" => "email-valid",
                "email.unique" => "email-exists",
                "password.required" => "pass-required",
                "password.between" => "pass-between",
                "role.digits_between" => "role-valid"
            ]
        );
        DB::insert("INSERT INTO users (name , email , password , role) VALUES(?,?,?,?)", [$validated_data['name'], $validated_data['email'], sha1($validated_data['password']), $validated_data['role']]);
        session()->flash("user-added", '1');
        return redirect(route("users"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = DB::selectOne("SELECT id , name , email , role FROM users WHERE id =?", [$id]);
        if ($user != NULL) {
            return view("layouts.edit_user", ["user" => $user]);
        } else return redirect(route("users"));
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
                "name" => "required|max:20|regex:/^[a-z _]+$/i",
                "email" => "required|email|unique:users,email," . $id, ",id",
                "password" => "required|between:8,12",
                "role" => 'digits_between:0,2'
            ],
            [
                "name.required" => "name-required",
                "name.regex" => "name-valid",
                "name.max" => "name-big",
                "email.required" => "email-required",
                "email.email" => "email-valid",
                "email.unique" => "email-exists",
                "password.required" => "pass-required",
                "password.between" => "pass-between",
                "role.digits_between" => "role-valid"
            ]
        );
        DB::insert("UPDATE users SET name=? , email=? , role=?,password=? WHERE id =?", [$validated_data['name'], $validated_data['email'], $validated_data['role'], sha1($validated_data['password']), $id]);
        session()->flash("user-updated", '1');
        if ($id == session()->get("id")) {
            session()->put("name", $validated_data['name']);
            session()->put("email", $validated_data['email']);
        }
        return redirect(route("users"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = DB::selectOne("SELECT id FROM users WHERE id =?", [$id]);
        if ($user) {
            DB::delete("DELETE FROM users WHERE id =?", [$id]);
            session()->flash("user-deleted", '1');
        }
        return redirect(route("users"));
    }
}
