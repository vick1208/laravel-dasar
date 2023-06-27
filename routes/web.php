<?php

use App\Exceptions\ValidationException;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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
    return "Page Not Found | Sorry";
});

Route::get('/products/{id}', function ($productId) {
    return "Product $productId";
})->name('product.detail');

Route::get('/products/{product}/items/{item}', function ($productId, $itemId) {
    return "Product $productId, Item $itemId";
})->name('product.item.detail');

Route::get('/categories/{id}', function ($categoryId) {
    return "Category $categoryId";
})->where('id', '[0-9]+')->name('category.detail');

Route::get('/users/{id?}', function ($userId = '404') {
    return "User $userId";
})->name('user.detail');

Route::get('/produk/{id}', function ($id) {
    $link = route('product.detail', ['id' => $id]);
    return "Link $link";
});

Route::get('/produk-redirect/{id}', function ($id) {
    return redirect()->route('product.detail', ['id' => $id]);
});


Route::get('/conflict/eko', function () {
    return "Conflict Eko Kurniawan Khannedy";
});

Route::get('/conflict/{name}', function ($name) {
    return "Conflict $name";
});

Route::get('/control/hello/request', [HelloController::class, 'request']);
Route::get('/control/hello/{name}', [HelloController::class, 'hello']);

Route::controller(InputController::class)->group(function () {
    Route::get('/input/hello', 'hello');
    Route::post('/input/hello', 'hello');
    Route::post('/input/hello/first', 'helloFirstName');
    Route::post('/input/hello/input', 'helloInput');
    Route::post('/input/hello/array', 'helloArr');
    Route::post('/input/type', 'inputType');
    Route::post('/input/filter/only', 'filterOnly');
    Route::post('/input/filter/except', 'filterExcept');
    Route::post('/input/filter/merge', 'filterMerge');
});

Route::post('/file/upload', [FileController::class, 'upload'])
    ->withoutMiddleware([VerifyCsrfToken::class]);

Route::get("response/hello", [ResponseController::class, 'response']);
Route::get("response/header", [ResponseController::class, 'header']);

Route::prefix("/response/type")->group(function () {
    Route::get('/view', [ResponseController::class, 'responseView']);
    Route::get('/json', [ResponseController::class, 'responseJson']);
    Route::get('/file', [ResponseController::class, 'responseFile']);
    Route::get('/download', [ResponseController::class, 'responseDownload']);
});

Route::prefix('/cookie')->group(function () {
    Route::get('/set', [CookieController::class, 'createCookie']);
    Route::get('/get', [CookieController::class, 'getCookie']);
    Route::get('/clear', [CookieController::class, 'clearCookie']);
});

Route::get('/redirect/from', [RedirectController::class, 'redirectFrom']);
Route::get('/redirect/to', [RedirectController::class, 'redirectTo']);
Route::get('/redirect/name', [RedirectController::class, 'redirectName']);
Route::get('/redirect/name/{name}', [RedirectController::class, 'redirectHello'])->name('redirect-hello');
Route::get('/redirect/action', [RedirectController::class, 'redirectAction']);
Route::get('/redirect/away', [RedirectController::class, 'redirectAway']);
Route::get('/redirect/named', function () {
    //    return route('redirect-hello', ['name' => 'Eko']);
    //    return url()->route('redirect-hello', ['name' => 'Eko']);
    return URL::route('redirect-hello', ['name' => 'Eko']);
});

Route::middleware(['example:PZN,401'])->prefix('/middleware')->group(function () {
    Route::get('/api', function () {
        return "OK";
    });
    Route::get('/group', function () {
        return "GROUP";
    });
});
Route::get('/url/action', function () {
    // return action([FormController::class, 'form'], []);
    // return url()->action([FormController::class, 'form'], []);
    return URL::action([FormController::class, 'form'], []);
});

Route::get('/form', [FormController::class, 'form']);
Route::post('/form', [FormController::class, 'submitForm']);

Route::get('/url/current', function () {
    return URL::full();
});

Route::get('session/make', [SessionController::class, 'createSession']);
Route::get('session/get', [SessionController::class, 'getSession']);

Route::get('error/sample', function () {
    throw new Exception("Throwing Error");
});
Route::get('/error/manual', function () {
    report(new Exception("Throw Error"));
    return "OK";
});
Route::get('/error/validation', function () {
    throw new ValidationException("Validation Error");
});

Route::get('/abort/400', function () {
    abort(400, "Validation Error ");
});

Route::get('/abort/401', function () {
    abort(401);
});

Route::get('/abort/500', function () {
    abort(500);
});
