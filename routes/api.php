<?php

use App\Http\Controllers\BookController;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
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

//show all books
Route::get('/books', function () {
    return BookResource::collection(Book::all());
});

//display one book from it's id
Route::get('/book/{id}', function ($id) {
    return new BookResource(Book::findOrFail($id));
});

//Update books
Route::put('/book/{id}', [BookController::class, 'update']);

//Delete listing
Route::delete('/book/{id}', [BookController::class, 'destroy']);


//a route so that we can send a POST request to store the record into the database 'store' is the method
Route::post('/book', [BookController::class, 'store']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
