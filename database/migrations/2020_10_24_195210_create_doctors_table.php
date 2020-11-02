<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('last_name', 90);
            $table->string('name', 90);
            $table->string('full_name', 181)->index();
            $table->date('birth_date')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->tinyInteger('gender')->default(0);
            $table->string('titles')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}