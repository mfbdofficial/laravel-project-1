<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing; //untuk memakai Model Listing

class ListingController extends Controller
{
    //to get all listings data from Model and then show it in the View
    public function index(Request $request)
    {
        /*
        dd(request()); //menampilkan semua isi object request pakai Helper Function
        dd(request('tag')); //menampilkan isi object request key 'tag' (dari query parameter) pakai Helper Function
        dd(request(['tag'])); //sama seperti di atas tapi langsung dimasukkan jadi array
        //cara Helper Function tidak perlu parameter Request $request di method Controller-nya
        dd($request); //menampilkan semua isi object request pakai Dependency Injection
        dd($request->input('tag')); //menampilkan isi object request key 'tag' (dari query parameter) pakai Dependency Injection
        */

        /*
        return view('listings', [
            'heading' => 'Latest Listings', //kita sudah tidak butuh data ini (tidak dipakai di View yg sekarang), tapi karena ada bekas code percobaan sebelumnya maka biarkan saja
            'listings' => Listing::all() //di Model sudah ada default method all() untuk mengambil semua data Model itu
        ]); //lalu sebenarnya juga ada mehotd find() untuk mengambil 1 data saja
        */
        //sekarang sudah pakai best practice untuk penamaan dan struktur View-nya
        return view('listings.index', [
            'heading' => 'Latest Listings', //kita sudah tidak butuh data ini (tidak dipakai di View yg sekarang), tapi karena ada bekas code percobaan sebelumnya maka biarkan saja
            //'listings' => Listing::all() //di Model sudah ada default method all() untuk mengambil semua data Model itu
            //'listings' => Listing::latest()->get() //ini sama kayak all() tapi diurutkan dari data yang paling baru ditambahkan
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get() //ini request(['tag'])-nya termasuk cara Helper Function
            //cara kerjanya jadi pertama kita sort atau urutkan pakai latest(),
            //kedua kita filter datanya pakai filter() akan berhubungan dengan method scopeFilter() di Model-nya (di sana bikin query dengan WHERE clause),
            //ketiga melakukan get() untuk ambil data setelah lakukan filter(), 
            //kalo hasil filter tidak ada yg cocok maka mengembalikan semua data, kalo ada maka balikkannya adalah yg sesuai hasil filter
        ]);
    }

    //to get single listing data from Model and the show it in the View
    public function show(Listing $listing)
    {
        /*
        return view('listing', [
            'listing' => $listing
        ]);
        */
        //sekarang sudah pakai best practice untuk penamaan dan struktur View-nya
        return view('listings.show', [
            'listing' => $listing
        ]);
    }
}
