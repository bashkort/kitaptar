<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
class RedactorsActionsController extends Controller
{
    public function __construct()
    {
      $this->middleware(['auth', 'checkRole']);
    }
    public function mergeBooks(Book $mainBook, Book $depBook)
    {
      foreach($depBook->files as $file){
        $file->book_id = $mainBook->id;
        $file->save();
      }
      $depBook->redirect = $mainBook->id;
      $depBook->active = 0;
      $depBook->save();
      return redirect()->route("book_page", ['id' => $mainBook->id]);
    }
}
