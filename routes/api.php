<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Public Routes(All)

*/
//Route::resource('products', ProductController::class);

//User Registration Route
Route::post('/register', [AuthController::class, 'register']);
//User Login Route
Route::post('/login', [AuthController::class, 'login']);
// Index products routes GET Request
Route::get('/products', [ProductController::class, 'index']);
// Individual products routes GET Request
Route::get('/products/{id}', [ProductController::class, 'show']);
// Searching products routes Get Request
Route::get('/products/search/{name}', [ProductController::class, 'search']);


// Protected Route

// Route::middleware('auth:sanctum')->get('/user', function () {
//     Route::get('/products/search/{name}', [ProductController::class, 'search']);
// });
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Creating products routes Post Request
    Route::post('/products', [ProductController::class, 'store']);
    // Updating products routes Post Request
    Route::put('/products/{id}', [ProductController::class, 'update']);
    // Deleting products routes Post Request
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
