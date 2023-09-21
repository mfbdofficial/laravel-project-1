<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
//class Listing
{
    //MATERI DATABASE IN LARAVEL - Penggunaan Model, Migration, Seeder, Factory Terkoneksi MySQL
    use HasFactory;

    //MATERI LARAVEL ELOQUENT - Model
    //sumber data bagian ini masih hardcode belum dari database
    /*
    public static function all() {
        return [
            [
                'id' => 1,
                'title' => 'Listing One',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum, quos ratione blanditiis impedit laborum repudiandae perferendis id aliquid. Placeat aperiam perspiciatis exercitationem minus ea sed possimus pariatur quidem doloribus nihil!'
            ],
            [
                'id' => 2,
                'title' => 'Listing Two',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum, quos ratione blanditiis impedit laborum repudiandae perferendis id aliquid. Placeat aperiam perspiciatis exercitationem minus ea sed possimus pariatur quidem doloribus nihil.'
            ]
        ]; //nanti bagian data ini harusnya berasal dari database
    }

    public static function find($id) {
        //kita mau siapin semua data terlebih dahulu, pakai saja method di atas yg sudah kita buat
        //ingat kalo class memakai property atau method diri sendiri di dalam class itu sendiri, pakai keyword self
        $listings = self::all();

        foreach ($listings as $listing) {
            if ($listing['id'] == $id) {
                return $listing; //langsung return tanpa mekanisme memasukkan ke array baru,
                //karena kemungkinan semua data memiliki value key 'id' yg berbeda
            }
        }
    }
    */
    //code sudah ditimpa oleh
}
