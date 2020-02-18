<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('projects', function (Blueprint $table) {
            $table->string('customerNameCN')->nullable($value = true);
            $table->string('customerNameEN')->nullable($value = true);
            $table->string('region')->nullable($value = true);
            $table->string('sales')->nullable($value = true);
            $table->string('programName')->nullable($value = true);
            $table->string('prodLine')->nullable($value = true);
            $table->string('partNumber')->nullable($value = true);
            $table->string('projectUnits')->nullable($value = true);
            $table->string('qtyBoard')->nullable($value = true);
            $table->string('asp')->nullable($value = true);
            $table->string('amount')->nullable($value = true);
            $table->string('confidencePercent')->nullable($value = true);
            $table->string('productionDate')->nullable($value = true);
            $table->string('supportNeeded')->nullable($value = true);
            $table->string('update')->nullable($value = true);
            $table->string('top10')->default('N');
            $table->integer('opportunity')->nullable($value = true);
            $table->string('createdDate')->nullable($value = true);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('projects');
    }
}
