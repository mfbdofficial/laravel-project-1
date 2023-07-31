<?php

//use App\Http\Controllers\HelloController;
use Illuminate\Support\Facades\Route;

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
}); //jadi kalo akses /produk/{id} maka akan kembalikan 
Route::get('/produk-redirect/{id}', function($id) { //misal ada sebuah route, kita mau jika ia diakses maka akan melakukan redirect ke Route lain yg sudah kita beri nama Route-nya
    return redirect()->route('product.detail', ['id' => $id]); //return lalu pakai function redirect() lalu route(<nama_route>, <array_associative_parameter>) untuk lakukan redirect ke route yg kita tentukan (dengan bawa parameter)
}); //selai dengan Route::redirect(), kita juga bisa melakukan redirect dengan function redirect()->route() seperti di atas (di-return oleh closure function)
//kalo link dari Route lain (yg sudah ada nama route-nya) tidak butuh parameter, maka bisa langsung route(<nama_route>), tanpa bawa parameter

//MATERI CONTROLLER - Membuat Function di Controller
/*
Route::get('/controller/hello', [\App\Http\Controllers\HelloController::class, 'hello']); //jadi sistemnya simple cuma seperti maping saja, untuk link apa? maka jalankan Controller mana dan function-nya yg mana
*/

//MATERI CONTROLLER - Dependency Injection
Route::get('/controller/hello/{name}', [\App\Http\Controllers\HelloController::class, 'hello']); //sekarang ada parameter karena dari function hello() di dependency HelloServiceIndonesia butuh parameter
//parameter akan otomatis masuk ke parameter pertama di Controller-nya, begitu pula berikutnya (sesuai urutan)