<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DB_Controller extends Controller
{
    private $layout = "layouts.db.index";
    public function index()
    {
        return view($this->layout);
    }
}
