<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Logs extends Controller
{
    public function index()
    {
        return view("layouts.logs", ['logs' => DB::select("SELECT * FROM logs")]);
    }
    public function delete($id)
    {
        $log = DB::select("SELECT id FROM logs WHERE id =?", [$id]);
        if ($log) {
            DB::delete("DELETE FROM logs WHERE id =?", [$id]);
            session()->flash("log-deleted", '1');
        }
        return redirect(route("logs"));
    }
    public function deleteAll()
    {
        if (DB::select("SELECT id FROM logs LIMIT 1")) {
            DB::delete("DELETE FROM logs");
            session()->flash("logs-deleted", '1');
        } else {
            session()->flash("no-logs", '1');
        }
        return redirect(route("logs"));
    }
}
