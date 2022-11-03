<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("settings", function (Blueprint $tbl) {
            $tbl->id();
            $tbl->string("website_name", 20)->nullable();
            $tbl->string("website_url")->nullable();
            $tbl->boolean("installed")->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("settings");
    }
};
