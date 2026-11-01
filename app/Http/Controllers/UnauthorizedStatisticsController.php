<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
class UnauthorizedStatisticsController extends Controller
{
  public function view(Book $book)
  {
    $book->unauthorized_views_count += 1;
    $book->rating += 1;
    $book->save();
  }
  public function download(Book $book)
  {
    $book->unauthorized_downloads_count += 1;
    $book->rating += 5;
    $book->save();
  }
}
