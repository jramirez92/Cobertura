<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistribucionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribucion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empalme_id')->constrained('empalme');
            $table->smallInteger('cp')->unsigned();
            $table->foreignId('calle_id')->constrained('callejero');
            $table->smallInteger('numero')->unsigned();
            $table->float('lat', 9, 7);
            $table->float('lon', 9, 7);
            $table->smallInteger('in')->unsigned()->default(1);
            $table->smallInteger('out')->unsigned()->default(4);
            $table->smallInteger('con')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distribucion');
    }
}
