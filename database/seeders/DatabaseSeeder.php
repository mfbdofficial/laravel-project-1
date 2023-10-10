<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Listing; //use untuk memakai Model Listing
use App\Models\User; //use untuk memakai Model User

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //MATERI DATABASE IN LARAVEL - Laravel Seeder
        /*
        \App\Models\User::factory(8)->create();
        */
        //code sudah ditimpa oleh MATERI DATABASE IN LARAVEL - Membangun Relationship Antara Table di Database Laravel

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //cara pakai Seeder kalo datanya hardcode
        /*
        \App\Models\Listing::create([
            'title' => 'Laravel Senior Developer', 
            'tags' => 'laravel, javascript',
            'company' => 'Acme Corp',
            'location' => 'Boston, MA',
            'email' => 'email1@email.com',
            'website' => 'https://www.acme.com',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima et illo reprehenderit quas possimus voluptas repudiandae cum expedita, eveniet aliquid, quam illum quaerat consequatur! Expedita ab consectetur tenetur delensiti?'    
        ]);
        //di bawah ini penulisan kalo sudah pakai use, sama aja seperti di atas
        Listing::create([
            'title' => 'Full-Stack Engineer',
            'tags' => 'laravel, backend ,api',
            'company' => 'Stark Industries',
            'location' => 'New York, NY',
            'email' => 'email2@email.com',
            'website' => 'https://www.starkindustries.com',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima et illo reprehenderit quas possimus voluptas repudiandae cum expedita, eveniet aliquid, quam illum quaerat consequatur! Expedita ab consectetur tenetur delensiti?'
        ]);
        */

        //MATERI DATABASE IN LARAVEL - Penggunaan Model, Migration, Seeder, Factory Terkoneksi MySQL
        //cara pakai Seeder kalo datanya sudah dihasilkan Factory untuk buat dummy data
        /*
        Listing::factory(6)->create();
        */
        //code sudah ditimpa oleh MATERI DATABASE IN LARAVEL - Membangun Relationship Antara Table di Database Laravel

        //MATERI DATABASE IN LARAVEL - Membangun Relationship Antara Table di Database Laravel
        $user = User::factory()->create([
            'name' => 'Alex Ferguson',
            'email' => 'alexferguson01@gmail.com'
        ]);

        Listing::factory(6)->create([
            'user_id' => $user->id
        ]);
    }
}
