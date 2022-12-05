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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('titulo',100)->unique();
            $table->string('autor', 100);
            $table->string('editorial', 100);
            $table->string('isbn', 13)->unique();
            $table->integer('numero_paginas');
            $table->string('edicion',100);
            $table->string('año_lanzamiento');
            $table->text('sinopsis');
            $table->string('pdf',200);
            $table->string('imagen',200);
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelele('cascade')->onUpdate("cascade");
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
