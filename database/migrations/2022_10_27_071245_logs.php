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
        Schema::create("logs", function (Blueprint $tbl) {
            $tbl->id();
            $tbl->text("action");
            $tbl->unsignedBigInteger("who");
            $tbl->foreign("who")->references("id")->on("users")->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists("logs");
    }
};
