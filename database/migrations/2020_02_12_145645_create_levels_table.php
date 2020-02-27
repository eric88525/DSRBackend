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
            $table->string('no');
            $table->string('customerNameCN');
            $table->string('customerNameEN');
            $table->string('region');
            $table->string('sales');
            $table->string('prodLine');
            $table->string('programName');
            $table->string('opportunity');
            $table->string('partNumber');
            $table->string('epsomnNote');
            $table->string('qty');
            $table->string('pcsBoard');
            $table->string('unitPrice');
            $table->string('amount');
            $table->string('dwStatus');
            $table->string('remark');
            $table->string('renewDay');
            $table->string('productionDate');
            $table->string('createDate');
            $table->string('industrySegment');
            $table->string('top10');
            $table->string('regLineStatus');
            $table->string('note');
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
