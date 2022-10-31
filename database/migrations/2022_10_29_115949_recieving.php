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
        Schema::create("receiving", function (Blueprint $tbl) {
            $tbl->id();
            $tbl->bigInteger("supplier", false, true);
            $tbl->bigInteger("product", false, true);
            $tbl->json("details");
            $tbl->foreign("supplier")->on("partners")->references("partner_id")->onUpdate("cascade")->onDelete("cascade");
            $tbl->foreign("product")->on("products")->references("id")->onUpdate("cascade")->onDelete('cascade');
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
        Schema::dropIfExists("receiving");
    }
};
