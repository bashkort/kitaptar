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

use App\Author;
use App\Book;
use App\Read;
use App\User;
use Illuminate\Http\Request;

// Main page
Route::get("/", function () {
    return view("welcome");
})->name("search");

// Book page
Route::get("book/{book}", function ($id) {
    if (!is_numeric($id)) {
        $book = Book::where("alias", $id)->firstOrFail();
    } else {
        $book = Book::findOrFail($id);
    }
    if ($book->redirect != 0) {
        $book = Book::findOrFail($book->redirect);
    }
    return view("pages/book", array("book" => $book));
})->name("book_page");

// Author page
Route::get("author/{author}", function (Author $author) {
    return view("pages/author", array("author" => $author));
});
Route::get("authors", function () {
    return view("authors_rating");
});
Route::get("users", function () {
    return view("users_rating");
});

// Unauthorized stats
Route::post("unauthorized_download/{book}", "UnauthorizedStatisticsController@download");
Route::post("unauthorized_view/{book}", "UnauthorizedStatisticsController@view");

// Authorization routes
Auth::routes();

// Next - routes with auth required

// Home page
Route::get("/my", "HomeController@index");

// Reading
Route::get("read/{file}", "ReaderController@showReader");
Route::post("change_page/{book}", function (Book $book, Request $request) {
    $read = Read::where("user_id", Auth::user()->id)->where("book_id", $book->id)->first();
    $read->page = $request->page;
    $read->save();
})->middleware("auth");

// Stats
Route::post("authorized_download/{book}", "AuthorizedStatisticsController@download");
Route::post("authorized_view/{book}", "AuthorizedStatisticsController@view");
Route::post("like/{book}", "AuthorizedStatisticsController@like");
Route::post("unlike/{book}", "AuthorizedStatisticsController@unlike");
Route::post("read/{book}", "AuthorizedStatisticsController@read");

// Books
Route::get("add_book", "BookInsertController@show_form")->name("add_book");;
Route::post("add_book", "BookInsertController@add_book");

// Editing
Route::get("/edit/book/{book}", function (Book $book) {
    return view("edit/book", array("book" => $book));
})->name("edit_book")->middleware("auth", "canEdit");
Route::post("/edit/book/{book}", "BookEditController@edit");
Route::get("mergeBooks/{mainBook}/{depBook}", "RedactorsActionsController@mergeBooks");

Route::get("delete/file/{file}", "DeleteController@file");
Route::get("delete/book/{book}", "DeleteController@book");
Route::get("recover/file/{file}", "DeleteController@recover_file");
Route::get("recover/book/{book}", "DeleteController@recover_book");


// User page
Route::get("user/{user}", function (User $user) {
    return view("pages/user", array("user" => $user));
})->middleware("auth");

// Book list
Route::get("list", function () {
    return view("list");
});
