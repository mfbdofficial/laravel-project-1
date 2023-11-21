<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing; //untuk memakai Model Listing
use Illuminate\Support\Facades\File; //untuk memakai Facade File
use Illuminate\Support\Facades\Session; //untuk memakai Facade Session
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

        //MATERI PENERAPAN LARAVEL UNTUK FITUR PROJECT - Membuat Pagination
        //coba bandingkan isi keduanya
        //dd(Listing::latest()->filter(request(['tag', 'search']))->get()); //cuma property items
        //dd(Listing::latest()->filter(request(['tag', 'search']))->paginate(4)); //mengandung banyak property tentang page
        return view('listings.index', [
            'heading' => 'Latest Listings', //kita sudah tidak butuh data ini (tidak dipakai di View yg sekarang), tapi karena ada bekas code percobaan sebelumnya maka biarkan saja
            //'listings' => Listing::all() //di Model sudah ada default method all() untuk mengambil semua data Model itu
            //'listings' => Listing::latest()->get() //ini sama kayak all() tapi diurutkan dari data yang paling baru ditambahkan
            /*
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get() //ini request(['tag'])-nya termasuk cara Helper Function
            */ 
            //code sudah ditimpa oleh MATERI PENERAPAN LARAVEL UNTUK FITUR PROJECT - Membuat Pagination
            //cara kerjanya jadi pertama kita sort atau urutkan pakai latest(),
            //kedua kita filter datanya pakai filter() akan berhubungan dengan method scopeFilter() di Model-nya (di sana bikin query dengan WHERE clause),
            //ketiga melakukan get() untuk ambil data setelah lakukan filter(), 
            //kalo hasil filter tidak ada yg cocok maka mengembalikan semua data, kalo ada maka balikkannya adalah yg sesuai hasil filter
            //MATERI PENERAPAN LARAVEL UNTUK FITUR PROJECT - Membuat Pagination
            //'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(4) //method links() di View-nya akan membuat pagination complex dengan tulisan angka page-nya
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->simplePaginate(4) // method links() di View-nya akan membuat pagination sederhana hanya dengan tulisan "Next" dan "Previous"
            //jika sudah pakai Helper Function paginate() ini, maka Route-nya bisa menerima Query Parameter "page"  
        ]);
    }

    //to get single listing data from Model and then show it in the View
    public function show(Listing $listing) //Dependency Injection mengambil data Model (Listing) dengan menggunakan id-nya (lalu didapatkan object $listing)
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

    //MATERI DATABASE IN LARAVEL - INSERT Database in Laravel
    //to show a page (form) for create a new job listing
    public function create()
    {
        return view('listings.create');
    }

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

        //MATERI FILE UPLOAD
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        //melakukan INSERT ke database
        Listing::create($formFields);
        //cara di bawah ini juga bisa langsung INSERT ke database tanpa validation dan membuat variable baru untuk field tertentu
        //Listing::create($request->all()); //jika sudah meng-off kan field protection di AppServiceProvider, sebaiknya jangan pakai cara ini, takutnya ada data lain selain field yg kita maksud di database ikut masuk

        //MATERI CONTROLLER - Flash Message di Controller
        //$request->session()->flash('message', 'Listing Created'); //cara Dependency Injection
        //Session::flash('message', 'Listing Created'); //cara Facade
        //session()->flash('message', 'Listing Created'); //cara Helper Function (cara ini tidak kena error extension PHP Intelephense)
        //kemungkinan di atas itu method flash() di Laravel (cara Dependency Injection dan Facade) error cuma dari extension PHP Intelephense (sebenarnya bisa jalan), jadi pakai method with() seperti di bawah
        //coba baca masalah tentang method flash() ini di https://stackoverflow.com/questions/71892173/undefined-flash-method-in-laravel-9
        return redirect('/home')->with('message', 'Listing created successfully!'); //kalo udah selesai maka redirect ke path /home
    }

    //MATERI DATABASE IN LARAVEL - UPDATE Database in Laravel
    //to show a page (form) for edit (UPDATE data) a job listing
    public function edit(Listing $listing) 
    {
        /*
        dd($listing);
        dd($listing->title);
        */
        return view('listings.edit', ['listing' => $listing]);
    }

    //to store a new listing data from the edit form page
    public function update(Request $request, Listing $listing)
    {
        //sebelum proses update, pastikan terlebih dahulu, yg melakukan update listing itu user yg benar (sama dengan user yg login saat itu)
        //cek apakah nilai field user_id yg sebagai Foreign Key, sama dengan data id milik user yg login sekarang
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action!');
        } //ini fungsinya untuk mem-protect saja, bisa jadi ada yg iseng tiba - tiba bisa edit listing yg bukan punya user itu, jadi kita pertahankan lagi di logic ini

        $formFields = $request->validate([
            'title' => 'required', //required artinya tidak boleh kosong
            /*
            'company' => ['required', Rule::unique('listings', 'company')], //pakai bantuan Rule:unique(), artinya data ga boleh sama, parameter-nya array ['table_name', 'field_name']
            */
            'company' => ['required'], //peraturan Rule::unique('listings', 'company') dihilangkan, karena bisa jadi orangnya tidak ingin ubah nama company-nya, karena kalo ada Rule:unique() maka ga bisa lanjut kalo value company-nya sama
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'], //email artinya harus dalam bentuk email yg valid
            'tags' => 'required',
            'description' => 'required',
        ]);

        if($request->hasFile('logo')) {
            if($listing->logo) {
                File::delete(storage_path('app/public/' . $listing->logo));
            }
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        //$listing->update($formFields); //ini cara Dependency Injection
        Listing::where('id', $listing->id)->update($formFields); //ini cara memakai method pada Model-nya

        /*
        return redirect('/home')->with('message', 'Listing updated successfully!');
        return back()->with('message', 'Listing updated successfully!'); //back() itu kembali ke halaman sebelumnya
        */
        return redirect('/home/listings/' . $listing->id)->with('message', 'Listing updated successfully!');
    }

    //MATERI DATABASE IN LARAVEL - DELETE Database in Laravel
    //to delete a listing 
    public function destroy(Listing $listing) 
    {
        //sebelum proses delete, pastikan terlebih dahulu, yg melakukan delete listing itu user yg benar (sama dengan user yg login saat itu)
        //cek apakah nilai field user_id yg sebagai Foreign Key, sama dengan data id milik user yg login sekarang
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action!');
        } //ini fungsinya untuk mem-protect saja, bisa jadi ada yg iseng tiba - tiba bisa delete listing yg bukan punya user itu, jadi kita pertahankan lagi di logic ini

        $listing->delete();
        return redirect('/home')->with('message', 'Listing deleted successfully!');
    }

    //to manage listings that the user have
    public function manage()
    {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}