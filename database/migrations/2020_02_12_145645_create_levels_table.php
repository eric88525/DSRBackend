<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->string('level');
            $table->string('customerNameCN')->default('00');
            $table->string('customerNameEN')->default('00');
            $table->string('region')->default('00');
            $table->string('sales')->default('00');
            $table->string('programName')->default('00');
            $table->string('prodLine')->default('00');
            $table->string('partNumber')->default('00');
            $table->string('projectUnits')->default('00');
            $table->string('qtyBoard')->default('00');
            $table->string('asp')->default('00');
            $table->string('amount')->default('00');
            $table->string('confidencePercent')->default('00');
            $table->string('productionDate')->default('00');
            $table->string('supportNeeded')->default('00');
            $table->string('update')->default('00');
            $table->string('top10')->default('00');
            $table->string('opportunity')->default('00');
            $table->string('createdDate')->default('00');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('levels');
    }
}
