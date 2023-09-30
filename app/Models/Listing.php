<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
//class Listing
{
    //MATERI DATABASE IN LARAVEL - Penggunaan Model, Migration, Seeder, Factory Terkoneksi MySQL
    use HasFactory;

    //MATERI DATABASE IN LARAVEL - INSERT Database in Laravel
    //property ini harus dimasukkan ketika melakukan INSERT ke database pakai create() di Controller, karena ada suatu protection dari Laravel jadi nama field-nya harus disebut di property $fillable ini
    /*
    protected $fillable = ['title', 'company', 'location', 'website', 'email', 'tags', 'description'];
    */

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

    public function scopeFilter($query, array $filters) 
    {
        /*
        dd($filters['tag']);
        */

        //lakukan cek pakai double question mark, artinya "jika ini tidak false maka lakukan ..."
        if($filters['tag'] ?? false) {
            //$query->where('tags', 'LIKE', '%' . $filters['tag'] . '%'); //bisa pakai $filters ini yg datanya di-passing dari Controller, lalu pakai Model method filter()
            $query->where('tags', 'LIKE', '%' . request('tag') . '%'); //atau bisa pakai Helper Function untuk cek data tag-nya ke $query
            //tapi untuk cara Dependency Injection object $request tidak bisa dilakukan, karena sudah aturan scopeFilter() hanya menerima 2 parameter ($query dan $filters)
            
        }

        if($filters['search'] ?? false) {
            $query->where('title', 'LIKE', '%' . request('search') . '%')
                ->orWhere('description', 'LIKE', '%' . request('search') . '%')
                ->orWhere('tags', 'LIKE', '%' . request('search') . '%')
                ->orWhere('location', 'LIKE', '%' . request('search') . '%'); 
        }
    }
}
