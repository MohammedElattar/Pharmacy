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
        Schema::create("sales", function (Blueprint $tbl) {
            $tbl->id();
            $tbl->bigInteger("product", false, true);
            $tbl->foreign("product")->on("products")->references("id")->onUpdate('cascade')->onDelete('cascade');
            $tbl->string("details", 200);
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
        Schema::dropDatabaseIfExists("sales");
    }
};
