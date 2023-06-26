<?php

use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/awesome', function () {
    return view('hello', ['name' => 'Eko']);
});

Route::view('/hello', 'hello', ['name' => 'Eko']);

Route::view('/home', 'home.world', ['name' => 'Eko']);

Route::get('/pzn', function () {
    return 'Hello Programmer Zaman Now';
});

Route::redirect('/youtube', '/pzn');
Route::fallback(function () {
    return "Page Not Found 📎";
});

Route::get('/products/{id}', function ($productId) {
    return "Product $productId";
})->name('product.detail');

Route::get('/products/{product}/items/{item}', function ($productId, $itemId) {
    return "Product $productId, Item $itemId";
})->name('product.item.detail');

Route::get('/categories/{id}', function ($categoryId){
    return "Category $categoryId";
})->where('id', '[0-9]+')->name('category.detail');

Route::get('/users/{id?}', function ($userId = '404'){
    return "User $userId";
})->name('user.detail');

Route::get('/produk/{id}', function ($id){
    $link = route('product.detail', ['id' => $id]);
    return "Link $link";
});

Route::get('/produk-redirect/{id}', function ($id){
    return redirect()->route('product.detail', ['id' => $id]);
});


Route::get('/conflict/eko', function (){
    return "Conflict Eko Kurniawan Khannedy";
});

Route::get('/conflict/{name}', function ($name){
    return "Conflict $name";
});

Route::get('/control/hello/request',[HelloController::class,'request']);
Route::get('/control/hello/{name}',[HelloController::class,'hello']);

Route::controller(InputController::class)->group(function(){
    Route::get('/input/hello','hello');
    Route::post('/input/hello','hello' );
    Route::post('/input/hello/first','helloFirstName');
    Route::post('/input/hello/input','helloInput');
    Route::post('/input/hello/array','helloArr');
    Route::post('/input/type','inputType');
    Route::post('/input/filter/only','filterOnly');
    Route::post('/input/filter/except','filterExcept');
    Route::post('/input/filter/merge','filterMerge');

});

Route::post('/file/upload', [FileController::class,'upload']);

Route::get("response/hello",[ResponseController::class,'response']);
Route::get("response/header",[ResponseController::class,'header']);

Route::prefix("/response/type")->group(function (){
    Route::get('/view', [ResponseController::class, 'responseView']);
    Route::get('/json', [ResponseController::class, 'responseJson']);
    Route::get('/file', [ResponseController::class, 'responseFile']);
    Route::get('/download', [ResponseController::class, 'responseDownload']);
});

Route::get('/cookie/set',[CookieController::class, 'createCookie']);
Route::get('/cookie/get',[CookieController::class, 'getCookie']);
Route::get('/cookie/clear',[CookieController::class, 'clearCookie']);

Route::get('/redirect/from',[RedirectController::class,'redirectFrom']);
Route::get('/redirect/to',[RedirectController::class,'redirectTo']);
Route::get('/redirect/name', [RedirectController::class, 'redirectName']);
Route::get('/redirect/name/{name}', [RedirectController::class, 'redirectHello'])
    ->name('redirect-hello');
Route::get('/redirect/action',[RedirectController::class,'redirectAction']);
Route::get('/redirect/away',[RedirectController::class,'redirectAway']);