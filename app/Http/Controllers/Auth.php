<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Auth extends Controller
{
    public function index()
    {
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
            return redirect(route("login"));
        }
    }
}
