<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Book;
use \App\File;
class DeleteController extends Controller
{
    public function __construct()
    {
      $this->middleware(['auth', 'canEdit']);
    }
    public function file(File $file)
    {
      $file->active = 0;
      $file->save();
      return redirect()->route("book_page", ['id' => $file->book_id]);
    }
    public function book(Book $book)
    {
      $book->active = 0;
      $book->save();
      return redirect("/");
    }
}
