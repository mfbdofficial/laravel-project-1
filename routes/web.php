<?php

//use App\Http\Controllers\HelloController;
use Illuminate\Support\Facades\Route;
use App\Exceptions\ValidationException;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//MATERI ROUTING - Basic Routing
Route::get('/pzn', function() {
    return 'Hello Programmer Zaman Now';
});

//MATERI ROUTING - Redirect
Route::redirect('/youtube', '/pzn'); //yg akses path "youtube" akan di-redirect ke "pzn"

//MATERI ROUTING - Fallback Route
Route::fallback(function() {
    return '404 by Programmer Zaman Now';
});

//MATERI VIEW - Rendering View
Route::view('/hello', 'hello', ['name' => 'Fajar']);
Route::get('/hello-again', function() {
    return view('hello', ['name' => 'Fajar']);
});

//MATERI VIEW - Nested View Directory
Route::get('/hello-world', function() {
    return view('hello.world', ['name' => 'Fajar']);
});

//MATERI ROUTE PARAMETER - Route Parameter
/*
Route::get('/products/{id}', function($productId) {  
    return 'Product : ' . $productId;
});
Route::get('/products/{product}/items/{item}', function($productId, $itemId) { //nama parameternya dari url ke closure function tidak harus sama, nanti menyesuaikan sesuai urutannya.
    return 'Product : ' . $productId . ', Item : ' . $itemId;
});
*/

//MATERI ROUTE PARAMETER - Regular Expression Constraints
/*
Route::get('/categories/{id}', function($categoryId) {  
    return 'Category : ' . $categoryId;
})->where('id', '[0-9]+'); //kalo parameter yg dimasukkan tidak sesuai maka dia akan masuk ke Fallback Route (di atas)
*/
Route::get('/tasks/{task}/answers/{answer}', function($taskId, $answerId) {  
    return 'Task : ' . $taskId . ', Answer : ' . $answerId;
})->where('task', '[0-9]+')->where('answer', '[abcd]'); //misal regex {task} harus angka dan {answer} hanya boleh 1 dari a or b or c or d

//MATERI ROUTE PARAMETER - Optional Route Parameter
/*
Route::get('/users/{id?}', function($userId = '404') {  
    return 'User : ' . $userId;
});
*/

//MATERI ROUTE PARAMETER - Routing Conflict
Route::get('/conflict/fajar', function(string $name) {  
    return 'Conflict Fajar Budi';
}); //ini conflict dengan yg di bawah, karena ketika kita melakukan get ke /conflict/fajar itu sama seperti melakukan /conflict/{name},
//maka akan masuk ke /conflict/fajar, karena posisinya ada di atas (diprioritaskan)
Route::get('/conflict/{name}', function(string $name) {  
    return 'Conflict ' . $name;
});

//MATERI NAMED ROUTE
Route::get('/products/{id}', function($productId) {  
    return 'Product : ' . $productId;
})->name('product.detail'); //function name() untuk memberi nama, isinya bebas asalkan bentuknya konsisten untuk semuanya
Route::get('/products/{product}/items/{item}', function($productId, $itemId) { 
    return 'Product : ' . $productId . ', Item : ' . $itemId;
})->name('product.item.detail'); //di sini itu pakai bentuk penamaan Route-nya yaitu pakai huruf kecil dan pemisah tanda titik
Route::get('/categories/{id}', function($categoryId) {  
    return 'Category : ' . $categoryId;
})->where('id', '[0-9]+')->name('category.detail');
Route::get('/users/{id?}', function($userId = '404') {  
    return 'User : ' . $userId;
})->name('user.detail'); //keuntungannya itu kita bisa akses nama Route-nya yg sama, walau url-nya berubah - ubah, kalo nama Route-nya sama maka aman

//MATERI NAMED ROUTE - Menggunakan Named Route
//contoh ini ada hubungannya dengan materi URL Generation, akan dibahas nanti
Route::get('/produk/{id}', function($id) { //misal ada sebuah route, kita mau kembalikan misal string link dari Route lain yg sudah kita beri nama Route-nya
    $link = route('product.detail', ['id' => $id]); //pakai function route() untuk mendapatkan link-nya, dengan parameter (<nama_route>, <array_associative_parameter>)
    return 'Link : ' . $link; //return string link yg sudah didapatkan
}); //jadi kalo akses /produk/{id} maka akan kembalikan string link dari "product.detail"
Route::get('/produk-redirect/{id}', function($id) { //misal ada sebuah route, kita mau jika ia diakses maka akan melakukan redirect ke Route lain yg sudah kita beri nama Route-nya
    return redirect()->route('product.detail', ['id' => $id]); //return lalu pakai function redirect() lalu route(<nama_route>, <array_associative_parameter>) untuk lakukan redirect ke route yg kita tentukan (dengan bawa parameter)
}); //selain dengan Route::redirect(), kita juga bisa melakukan redirect dengan function redirect()->route() seperti di atas (di-return oleh closure function)
//kalo link dari Route lain (yg sudah ada nama route-nya) tidak butuh parameter, maka bisa langsung route(<nama_route>), tanpa bawa parameter

//MATERI CONTROLLER - Membuat Function di Controller
/*
Route::get('/controller/hello', [\App\Http\Controllers\HelloController::class, 'hello']); //jadi sistemnya simple cuma seperti maping saja, untuk link apa? maka jalankan Controller mana dan function-nya yg mana
*/

//MATERI REQUEST - Request Method
Route::get('/controller/hello/request', [\App\Http\Controllers\HelloController::class, 'request']); //ditaruh di atas MATERI CONTROLLER - Dependency Injection agar tidak routing conflict

//MATERI CONTROLLER - Dependency Injection
Route::get('/controller/hello/{name}', [\App\Http\Controllers\HelloController::class, 'hello']); //sekarang ada parameter karena dari function hello() di dependency HelloServiceIndonesia butuh parameter
//parameter akan otomatis masuk ke parameter pertama di Controller-nya, begitu pula berikutnya (sesuai urutan)

//MATERI REQUEST INPUT - Mengambil Input HTTP Request
Route::get('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']); 
Route::post('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']); //coba pakai HTTP Request Method yg berbeda tapi menuju ke Controller dan method yg sama (jadi hanya di-handle 1 code)
Route::get('/search', function(Request $request) {
    //dd($request);
    dd($request->name . ' ' . $request->city);
});

//MATERI REQUEST INPUT - Nested Input
Route::post('/input/hello/first', [\App\Http\Controllers\InputController::class, 'helloFirstName']);

//MATERI REQUEST INPUT - Mengambil Semua Input
Route::post('/input/hello/input', [\App\Http\Controllers\InputController::class, 'helloInput']);

//MATERI REQUEST INPUT - Mengambil Array Input
Route::post('/input/hello/array', [\App\Http\Controllers\InputController::class, 'helloArray']);

//MATERI REQUEST INPUT - Input Query String
Route::post('/input/hello/query-parameter', [\App\Http\Controllers\InputController::class, 'helloQueryParameter']);

//MATERI INPUT TYPE - Boolean & Date
Route::post('/input/type', [\App\Http\Controllers\InputController::class, 'inputType']);

//MATERI FILTER REQUEST INPUT - Method Filter Request Input
Route::post('/input/filter/only', [\App\Http\Controllers\InputController::class, 'filterOnly']);
Route::post('/input/filter/except', [\App\Http\Controllers\InputController::class, 'filterExcept']);

//MATERI FILTER REQUEST INPUT - FIlter Merge
Route::post('/input/filter/merge', [\App\Http\Controllers\InputController::class, 'filterMerge']);

//MATERI FILE UPLOAD
/*
Route::post('/file/upload', [\App\Http\Controllers\FileController::class, 'upload']);
*/ 
//code sudah ditimpa oleh MATERI MIDDLEWARE - Exclude Middleware

//MATERI RESPONSE 
Route::get('/response/hello', [\App\Http\Controllers\ResponseController::class, 'response']);

//MATERI RESPONSE - HTTP Response Header
Route::get('/response/header', [\App\Http\Controllers\ResponseController::class, 'header']);

//MATERI RESPONSE - Response Type
/*
Route::get('/response/type/view', [\App\Http\Controllers\ResponseController::class, 'responseView']);
Route::get('/response/type/json', [\App\Http\Controllers\ResponseController::class, 'responseJson']);
Route::get('/response/type/file', [\App\Http\Controllers\ResponseController::class, 'responseFile']);
Route::get('/response/type/download', [\App\Http\Controllers\ResponseController::class, 'responseDownload']);
*/
//code sudah ditimpa oleh MATERI ROUTE GROUP - Route Prefix

//MATERI RESPONSE - Header Berpengaruh Dengan Isi Value response()
/*
Route::get('/response/hello', function() {
    return response('<h1>Hello World</h1>'); //maka isi string HTML ini akan di-render menjadi tag <h1></h1> HTML
}); //Header 'Content-Type' otomatis ber-value 'text/html'
*/
Route::get('/response/hello', function() {
    return response('<h1>Hello World</h1>') //tag <h1></h1> tidak di-render dan cuma menjadi string biasa
    ->header('Content-Type', 'text/plain'); //karena ada Header yg menegaskan isi tipe content-nya plain text biasa
});

//MATERI COOKIE - Membuat Cookie
/*
Route::get('/cookie/set', [\App\Http\Controllers\CookieController::class, 'createCookie']);
*/
//code sudah ditimpa oleh MATERI ROUTE GROUP - Route Controller

//MATERI COOKIE - Menerima Cookie
/*
Route::get('/cookie/get', [\App\Http\Controllers\CookieController::class, 'getCookie']);
*/
//code sudah ditimpa oleh MATERI ROUTE GROUP - Route Controller

//MATERI COOKIE - Clear Cookie
/*
Route::get('/cookie/clear', [\App\Http\Controllers\CookieController::class, 'clearCookie']);
*/
//code sudah ditimpa oleh MATERI ROUTE GROUP - Route Controller

//MATERI REDIRECT
Route::get('/redirect/from', [\App\Http\Controllers\RedirectController::class, 'redirectFrom']);
Route::get('/redirect/to', [\App\Http\Controllers\RedirectController::class, 'redirectTo']);

//MATERI REDIRECT - Redirect to Named Routes
Route::get('/redirect/name', [\App\Http\Controllers\RedirectController::class, 'redirectName']);
Route::get('/redirect/name/{name}', [\App\Http\Controllers\RedirectController::class, 'redirectHello'])
    ->name('redirect.hello'); //jadi kalo route path yg ini berubah2 aman, yang penting ada name untuk route-nya
//jadi di sini kita seolah mau buat kalo mengakses "/redirect/name" maka akan akses "/redirect/name/{nameDefault}" mendapatkan ucapan string dengan nilai $name default
//kalo akses "/redirect/name/{name}" dengan membawa parameter, maka yg dipakai adalah $name dari isi parameter-nya

//MATERI REDIRECT - Redirect to Controller Action
Route::get('/redirect/action', [\App\Http\Controllers\RedirectController::class, 'redirectAction']);

//MATERI REDIRECT - Redirect to External Domain
Route::get('/redirect/away', [\App\Http\Controllers\RedirectController::class, 'redirectAway']);

//MATERI MIDDLEWARE - Registrasi Middleware - Route Middleware
/*
Route::get('/middleware/api', function() {
    return 'OK';
})->middleware([\App\Http\Middleware\ContohMiddleware::class]); //bisa nulis class Middleware-nya
*/
/*
Route::get('/middleware/api', function() {
    return 'OK';
})->middleware(['contoh']); //atau bisa pakai alias Middleware-nya (yg sudah dibuat)
*/
//code sudah ditimpa oleh MATERI MIDDLEWARE - Middleware Parameter

//MATERI MIDDLEWARE - Middleware Group
//jadi selama ini, routing di file ini kita sudah memakai Middleware Group yg 'api'
/*
Route::get('/middleware/group', function() {
    return 'GROUP';
})->middleware(['sample']); //atau bisa pakai alias Middleware-nya (yg sudah dibuat)
*/
//code sudah ditimpa oleh MATERI ROUTE GROUP - Route Middleware

//MATERI MIDDLEWARE - Middleware Parameter
/*
Route::get('/middleware/api', function() {
    return 'OK';
})->middleware(['contoh:jojojojo,401']);
*/
//code sudah ditimpa oleh MATERI ROUTE GROUP - Route Middleware

//MATERI MIDDLEWARE - Exclude Middleware
Route::post('/file/upload', [\App\Http\Controllers\FileController::class, 'upload']) //menimpa code MATERI FILE UPLOAD
    ->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class); 

//MATERI CROSS SITE REQUEST FORGERY - CSRF Token
/*
Route::get('/form', [\App\Http\Controllers\FormController::class, 'renderForm']); //ingat, kita bisa bedakan routing berdasarkan HTTP Request Method-nya
*/
//code sudah ditimpa oleh MATERI URL GENERATION - URL untuk Controller Action
Route::post('/form', [\App\Http\Controllers\FormController::class, 'submitForm']); //jadi untuk membuat sebuah fungsi, tidak perlu kebanyakan endpoint

//MATERI ROUTE GROUP - Route Prefix
Route::prefix('/response/type')->group(function() {
    Route::get('view', [\App\Http\Controllers\ResponseController::class, 'responseView']);
    Route::get('json', [\App\Http\Controllers\ResponseController::class, 'responseJson']);
    Route::get('file', [\App\Http\Controllers\ResponseController::class, 'responseFile']);
    Route::get('download', [\App\Http\Controllers\ResponseController::class, 'responseDownload']);
});

//MATERI ROUTE GROUP - Route Middleware
/*
Route::middleware(['contoh:jojojojo,401'])->group(function() {
    Route::get('/middleware/group', function() {
        return 'GROUP';
    });
    Route::get('/middleware/api', function() {
        return 'OK';
    });
});
*/
//code sudah ditimpa oleh MATERI ROUTE GROUP - Multiple Route Group

//MATERI ROUTE GROUP - Route Controller
Route::controller(\App\Http\Controllers\CookieController::class)->group(function() {
    Route::get('/cookie/set', 'createCookie'); //tinggal sebutkan path dan nama method (tanpa class Controller-nya)
    Route::get('/cookie/get', 'getCookie'); //sebutkan nama method-nya pakai string, sudah bukan array
    Route::get('/cookie/clear', 'clearCookie');
});

//MATERI ROUTE GROUP - Multiple Route Group
Route::middleware(['contoh:jojojojo,401'])->prefix('/middleware')->group(function() {
    Route::get('/group', function() {
        return 'GROUP';
    });
    Route::get('/api', function() {
        return 'OK';
    });
});

//MATERI URL GENERATION - Current URL
Route::get('/url/currentfull', function() {
    //return url()->full() //ini kalo pakai url()
    return \Illuminate\Support\Facades\URL::full(); //ini kalo pakai Facade URL
});
Route::get('/url/current', function() {
    //return url()->current() //ini kalo pakai url()
    return \Illuminate\Support\Facades\URL::current(); //ini kalo pakai Facade URL
});

//MATERI URL GENERATION - URL untuk Named Routes
//sebelumnya pada MATERI REDIRECT - Redirect to Named Routes, kita sudah membuat named route dengan nama "redirect.hello"
//"redirect.hello" ini merupakan name untuk Route "/redirect/name/{name}", yg membawa parameter "name"
//sekarang kita pakai itu untuk contoh mengembalikan string URL pada named route
Route::get('/url/named', function() {
    //return route('redirect.hello', ['name' => 'Fajar']); //ini pake cara Helper Function, sama saja
    //return url()->route('redirect.hello', ['name' => 'Fajar']); //ini pake cara object url, sama saja
    return \Illuminate\Support\Facades\URL::route('redirect.hello', ['name' => 'Fajar']); //ini pake cara Facade URL
});

//MATERI URL GENERATION - URL untuk Controller Action
//misal ada sebuah Route
Route::get('/form', [\App\Http\Controllers\FormController::class, 'renderForm']);
//kita bisa return URL Route-nya berdasarkan Controller Action-nya (Controller dan Method Controller-nya)
Route::get('/url/action', function() {
    //return action([\App\Http\Controllers\FormController::class, 'renderForm'], []); //ini pake cara Helper Function, sama saja
    //return url()->action([\App\Http\Controllers\FormController::class, 'renderForm'], []); //ini pake cara object url, sama saja
    return \Illuminate\Support\Facades\URL::action([\App\Http\Controllers\FormController::class, 'renderForm'], []);
    //di contoh ini parameter-nya kosong (tidak bawa parameter)
});

//MATERI SESSION - Menyimpan Data ke Session
Route::get('/session/create', [\App\Http\Controllers\SessionController::class, 'createSession']);

//MATERI SESSION - Mengambil Data dari Session
Route::get('/session/get', [\App\Http\Controllers\SessionController::class, 'getSession']);

//MATERI ERROR HANDLING - Konfigurasi Error Handler
//MATERI ERROR HANDLING - Error Reporter
Route::get('/error/sample', function () {
    throw new Exception('Sample Error'); //misal bikin Route yg selalu melempar exception, nanti dilihat bedanya berdasarkan nilai 'debug' di config/app.php
});

//MATERI ERROR HANDLING - Manual Error Report
Route::get('/error/manual', function () {
    //jadi misal di bagian ini kita sedang melakukan try-catch untuk error handling,
    //nah kan biasanya kita melakukan throw exception kalo error (jadi error bisa ditampilkan, sekaligus Error Reporter-nya berjalan),
    //kalo ini kita tidak mau menampilkan halaman web error dengan melakukan throw exception, kita cuma mau men-trigger dan jalankan Error Reporter-nya saja
    report(new Exception('Sample Error'));
    return 'OK'; //misal telah terjadi error dan kita men-trigger Error Reporter-nya saja, tapi di halaman web tetap menampilkan "OK"
});

//MATERI ERROR HANDLING - Ignore Exception (Report)
//MATERI ERROR HANDLING - Rendering Exception
Route::get('/error/validation', function () {
    //throw new \App\Exceptions\ValidationException('Validation Error'); //ini bisa tapi entah kenapa penulisannya tidak disarankan oleh PHP Intelephense
    throw new ValidationException('Validation Error'); //jadi pakai bentuk ini, lalu pakai use namespace-nya, ada di atas
});

//MATERI ERROR HANDLING - Debug Dengan Hardcode
Route::get('/posts/{id}', function($id) {
    //dd($id);
    ddd($id);
    return response('Post ' . $id);
});

//MATERI HTTP EXCEPTION
/*
Route::get('/abort/400', function () {
    abort(400); //ini tanpa message
});
*/
//code sudah ditimpa oleh MATERI HTTP EXCEPTION - HTTP Error Page
Route::get('/abort/401', function () {
    abort(401);
});
Route::get('/abort/500', function () {
    abort(500);
});

//MATERI HTTP EXCEPTION - HTTP Error Page
Route::get('/abort/400', function () {
    abort(400, 'Ups Validation Error'); //ini membawa message
});



//PART WHERE THE PROJECT STARTS
/*
Route::get('/home', function() {
    return view('listings', [
        'heading' => 'Latest Listings',
        'listings' => [
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
        ]
    ]);
});
*/

//MATERI LARAVEL ELOQUENT - Model
//MATERI DATABASE IN LARAVEL - Penggunaan Model, Migration, Seeder, Factory Terkoneksi MySQL
use App\Models\Listing;
/*
Route::get('/home', function() {
    return view('listings', [
        'heading' => 'Latest Listings', //kita sudah tidak butuh data ini (tidak dipakai di View yg sekarang), tapi karena ada bekas code percobaan sebelumnya maka biarkan saja
        'listings' => Listing::all() //sekarang data sudah berasal dari Model, bukan hadrcode di Route-nya
    ]);
});
*/
//code sudah ditimpa oleh Route '/home' di bawah, sudah melalui Controller
/*
Route::get('/home/listings/{id}', function($id) {
    return view('listings', [
        'heading' => 'Latest Listings',
        'listings' => [Listing::find($id)] //ini kalo mau pakai halaman listings.blade.php, karena ada foreach jadi harus dibungkus array lagi,
        //karena melakukan looping lagi, tapi kita pakai halaman View yang baru saja yaitu listing.blade.php
    ]);
});
*/

/*
Route::get('/home/listings/{id}', function($id) {
    return view('listing', [
        'listing' => Listing::find($id)
    ]);
}); //kalo route ini kita akses untuk $id yg tidak ada maka akan error (menampilkan halaman Laravel, memberitahu detail error), karena belum kita handle
*/ //jadi pakailah cara di bawah
/*
Route::get('/home/listings/{id}', function($id) {
    $listing = Listing::find($id);
    //cek jika listing ada isinya, maka dia akan true
    if ($listing) {
        //kalo ada datanya maka kita return-kan
        return view('listing', [
            'listing' => $listing
        ]);
    } else {
        //kalo gaada maka lalukan sesuatu sesuka kita, misal kasih error 404
        abort('404');
    }   
}); //nah namun cara handling ini masih terlalu panjang, sebenarnya kita bisa lakukan Route Model Binding (berkat Eloquent Model) seperti di bawah
*/
//MATERI LARAVEL ELOQUENT - Model - Route Model Binding
//kita manfaatkan Eloquent Model untuk melakukan Route Model Binding
/*
Route::get('/home/listings/{listing}', function(Listing $listing) { //parameter id diganti karena ini bentuknya akan menjadi object $listing dari Model bernama Listing yg sudah kita buat
    //lalu kita bisa langsung return saja object $listing itu
    return view('listing', [
        'listing' => $listing
    ]); //tidak perlu melakukan error handling, karena akan otomatis kembalikan 404 secara default (kalo pake Route Model Binding di Eloquent)
});
*/
//code sudah ditimpa oleh Route '/home' di bawah, sudah melalui Controller


//listings Table Part 
//All Listings
Route::get('/home', [\App\Http\Controllers\ListingController::class, 'index']);

//MATERI DATABASE IN LARAVEL - INSERT Database in Laravel
//Show Create Form
Route::get('/home/listings/create', [\App\Http\Controllers\ListingController::class, 'create']); //agar tidak Routing Conflict, maka ini posisinya di atas
//Store Listing Data to Create
Route::post('/home/listings', [\App\Http\Controllers\ListingController::class, 'store']); 

//MATERI DATABASE IN LARAVEL - UPDATE Database in Laravel
//Show Edit (For Update Listing) Form
Route::get('/home/listings/{listing}/edit', [\App\Http\Controllers\ListingController::class, 'edit']); //kalo ada yg membawa parameter juga, yg path-nya lebih panjang maka ditaruh atas (agar terseleksi)
//Store Listing Data to Update
Route::put('/home/listings/{listing}', [\App\Http\Controllers\ListingController::class, 'update']);

//MATERI DATABASE IN LARAVEL - DELETE Database in Laravel
//Delete Listing
Route::delete('/home/listings/{listing}', [\App\Http\Controllers\ListingController::class, 'destroy']);

//Single Listing
Route::get('/home/listings/{listing}', [\App\Http\Controllers\ListingController::class, 'show']); //ini posisinya di bawah
//kalo path ini di atas, maka akan masuk ke path ini duluan tanpa sempat ke tempat yg path-nya lebih panjang (kita tidak menginginkan hal ini)


//users Table Part
//Show Register Create Form
Route::get('/home/register', [\App\Http\Controllers\UserController::class, 'create']);
//Store User Data to Create
Route::post('/home/users', [\App\Http\Controllers\UserController::class, 'store']);