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
        //MATERI DATABASE IN LARAVEL - Penggunaan Model, Migration, Seeder, Factory Terkoneksi MySQL
        Schema::create('listings', function (Blueprint $table) {
            $table->id(); //membuat field id, yg biasanya menjadi Primary Key
            //MATERI DATABASE IN LARAVEL - Membangun Relationship Antara Table di Database Laravel
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //constrained()->onDelete('cascade'), akan membuat jika ada user yg dihapus maka data listings milik dia juga terhapus semua
            $table->string('title'); //membuat field tipe data string dengan string(<nama_field>)
            //MATERI FILE UPLOAD
            $table->string('logo')->nullable(); //tipe-nya juga string karena yg kita simpan adalah path gambar-nya, nullable() artinya boleh kosong
            $table->string('tags');
            $table->string('company');
            $table->string('location');
            $table->string('email');
            $table->string('website');
            $table->longText('description'); //kalo untuk tipe data string yg kemungkinan isinya panjang maka pakai method longText()
            $table->timestamps(); //membuat field dengan tipe data waktu (timestamp), di database akan menjadi field "created_at"
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
