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
        Schema::create("products", function (Blueprint $tbl) {
            $tbl->id();
            $tbl->string("name", 30);
            $tbl->text("description");
            $tbl->boolean("require_reciepnt")->default("0");
            $tbl->integer("concentration", false, true);
            $tbl->bigInteger("med_type", false, true);
            $tbl->bigInteger("category_id", false, true);
            $tbl->foreign("med_type")->on("medicine_types")->references("id")->onUpdate("cascade")->onDelete("cascade");
            $tbl->foreign("category_id")->on("medicine_categories")->references("id")->onUpdate("cascade")->onDelete("cascade");
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
        Schema::dropIfExists("products");
    }
};