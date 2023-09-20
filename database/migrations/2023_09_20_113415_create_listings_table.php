<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id(); //membuat field id, yg biasanya menjadi Primary Key
            $table->string('title'); //membuat field tipe data string dengan string(<nama_field>)
            $table->string('tags');
            $table->string('company');
            $table->string('location');
            $table->string('email');
            $table->string('website');
            $table->longText('description'); //kalo untuk tipe data string yg kemungkinan isinya panjang maka pakai method longText()
            $table->timestamps(); //membuat field dengan tipe data waktu (timestamp)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
