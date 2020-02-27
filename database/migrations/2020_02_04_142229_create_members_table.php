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
            $table->string('no')->nullable($value = true);
            $table->string('customerNameCN')->nullable($value = true);
            $table->string('customerNameEN')->nullable($value = true);
            $table->string('region')->nullable($value = true);
            $table->string('sales')->nullable($value = true);
            $table->string('prodLine')->nullable($value = true);
            $table->string('programName')->nullable($value = true);
            $table->integer('opportunity')->nullable($value = true);
            $table->string('partNumber')->nullable($value = true);
            $table->string('epsomnNote')->nullable($value = true);
            $table->string('qty')->nullable($value = true);
            $table->string('pcsBoard')->nullable($value = true);
            $table->string('unitPrice')->nullable($value = true);
            $table->string('amount')->nullable($value = true);
            $table->string('dwStatus')->nullable($value = true);
            $table->string('remark')->nullable($value = true);
            $table->string('renewDay')->nullable($value = true);
            $table->string('productionDate')->nullable($value = true);
            $table->string('createDate')->nullable($value = true);
            $table->string('industrySegment')->nullable($value = true);
            $table->string('top10')->nullable($value = true);
            $table->string('regLineStatus')->nullable($value = true);
            $table->string('note')->nullable($value = true);

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
