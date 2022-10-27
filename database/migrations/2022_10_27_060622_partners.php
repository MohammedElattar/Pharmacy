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
        Schema::create("partners", function (Blueprint $tbl) {
            $tbl->id("partner_id");
            $tbl->string("name", 30);
            $tbl->timestamp("created_at")->useCurrent();
            $tbl->timestamp("updated_at")->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("partners");
    }
};
