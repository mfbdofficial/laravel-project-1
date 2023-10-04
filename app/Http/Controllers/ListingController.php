<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing; //untuk memakai Model Listing
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule; //untuk memakai fitur validasi Rule

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

    //to show a page (form) for create a new job listing
    public function create()
    {
        return view('listings.create');
    }

    //MATERI DATABASE IN LARAVEL - INSERT Database in Laravel
    //to store a listing data from the create form page 
    public function store(Request $request)
    {
        /*
        dd($request->all());
        */
        //melakukan validasi data di Laravel pakai validate()
        $formFields = $request->validate([
            'title' => 'required', //required artinya tidak boleh kosong
            'company' => ['required', Rule::unique('listings', 'company')], //pakai bantuan Rule:unique(), artinya data ga boleh sama, parameter-nya array ['table_name', 'field_name']
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'], //email artinya harus dalam bentuk email yg valid
            'tags' => 'required',
            'description' => 'required',
        ]);
        //melakukan INSERT ke database
        Listing::create($formFields);
        //cara di bawah ini juga bisa langsung INSERT ke database tanpa validation dan membuat variable baru untuk field tertentu
        //Listing::create($request->all()); //jika sudah meng-off kan field protection di AppServiceProvider, sebaiknya jangan pakai cara ini, takutnya ada data lain selain field yg kita maksud di database ikut masuk

        //MATERI CONTROLLER - Flash Message di Controller
        //$request->session()->flash('message', 'Listing Created'); //cara Dependency Injection
        //Session::flash('message', 'Listing Created'); //cara Facade
        //session()->flash('message', 'Listing Created'); //cara Helper Function (cara ini tidak kena error extension PHP Intelephense)
        //kemungkinan di atas itu method flash() di Laravel (cara Dependency Injection dan Facade) error cuma dari extension PHP Intelephense (sebenarnya bisa jalan), jadi pakai method with() seperti di bawah
        //coba baca masalah tentang method flas() ini di https://stackoverflow.com/questions/71892173/undefined-flash-method-in-laravel-9
        return redirect('/home')->with('message', 'Listing created successfully!'); //kalo udah selesai maka redirect ke path /home
    }
}