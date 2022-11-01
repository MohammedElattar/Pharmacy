<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class expired_products extends Controller
{
    private $tbl_name = "products";
    private $layout = "layouts.expired_products.index";
    private $main_name = "exp_prod";
    private $route = "exp_prod";
    private $message = "Expired Product";

    public function index()
    {
        $products = DB::select(
            "SELECT
            products.id ,
            products.name ,
            `exp`,
            medicine_types.name as `type`,
            medicine_categories.name as cat
        FROM
            products
        JOIN
            medicine_types
        ON
            medicine_types.id=products.med_type
        JOIN
            medicine_categories
        ON
            medicine_categories.id=products.category_id
        WHERE
            `exp` < ?",
            [date("Y-m-d H:i:s")]
        );
        return view($this->layout, ['expired_products' => $products]);
    }
}
