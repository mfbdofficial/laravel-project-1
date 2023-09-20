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
        //MATERI DATABASE IN LARAVEL - Laravel Migration 
        //file ini sudah default ada di Laravel, kita lihat contoh cara kerjanya
        //lihat di dalam method up() isinya dia membuat table dengan nama 'users'
        Schema::create('users', function (Blueprint $table) {
            //lalu di bagian bawah ini adalah field - field (kolom) untuk table-nya
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    //Kalo kita melakukan rollback untuk Migration-nya maka melakukan method ini
    public function down(): void
    {
        //bagian ini dia melakukan DROP untuk table-nya
        Schema::dropIfExists('users');
    }
};
