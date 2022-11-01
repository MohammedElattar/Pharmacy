<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Logout extends Controller
{
    public function index()
    {
        session()->flush();
        return redirect(route("login"));
    }
}
