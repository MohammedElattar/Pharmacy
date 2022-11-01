<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Ajax extends Controller
{
    private $objects = ['products'];
    private $operation = ['show'];
    public function process(Request $req, $obj, $operation)
    {
        $ar = [];
        $id = htmlspecialchars($req->input("id"));

        if (gettype(array_search($obj, $this->objects)) == 'integer') {

            if (gettype(array_search($operation, $this->operation)) == 'integer') {

                if (!preg_match("/^[0-9]+$/", $id)) $ar['id'] = '1';

                else {
                    if ($obj == 'products') {
                        if ($operation == 'show') {
                            $prod = DB::selectOne('SELECT qty , price FROM products WHERE id =?', [$id]);
                            if ($prod) {
                                $ar['success'] = '1';
                                $ar['data'] = $prod;
                            } else $ar['element'] = '1';
                        }
                    }
                }
            } else $ar['operation'] = '1';
        } else $ar['obj'] = '1';
        echo json_encode($ar);
    }
}
