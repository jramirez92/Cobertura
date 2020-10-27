<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndirectaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indirecta', function (Blueprint $table) {
            $table->id();
            $table->boolean('neba')->default('false');
            $table->foreignId('cp')->constrained('municipio');
            $table->foreignId('calle_id')->constrained('callejero,id');
            $table->smallInteger('numero')->unsigned();
            $table->float('lat', 9, 2);
            $table->float('lon', 9, 2);
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
        Schema::dropIfExists('indirecta');
    }
}
