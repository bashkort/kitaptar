<?php

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
use App\Book;
Route::get("/", function () {
    return view("welcome");
});
Route::get("book/{book}", function(Book $book){
    return view("book_page", array("book"=>$book));
})->name("book_page");

Route::post("download/{book}", function(Book $book){
    Auth::user()->downloads()->syncWithoutDetaching([$book->id]);
});
Route::post("view/{book}", function(Book $book){
    Auth::user()->views()->syncWithoutDetaching([$book->id]);
});
Route::post("like/{book}", function(Book $book){
    $book->likes()->syncWithoutDetaching([Auth::id()]);
});
Route::post("unlike/{book}", function(Book $book){
    $book->likes()->detach(Auth::id());
});
Auth::routes();
Route::get("add_book", "BookInsertController@show_form")->name("add_book");
Route::get("reindex", function (){
  Book::reindex();
});
Route::post("add_book", "BookInsertController@add_book");

Route::get("/home", "HomeController@index");
