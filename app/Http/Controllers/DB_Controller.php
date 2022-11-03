<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DB_Controller extends Controller
{
    private $layout = "layouts.DB.index";

    public function index()
    {
        return view($this->layout);
    }
    public function reset()
    {
        `php artisan migrate:refresh && php artisan db:seed`;
        return redirect("/");
    }
}
