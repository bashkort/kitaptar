<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Illuminate\Support\Facades\Auth;
class AuthorizedStatisticsController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    public function like(Book $book)
    {
      $book->likes()->syncWithoutDetaching([Auth::id()]);
      $book->likes_count += 1;
      $book->rating += 5;
      $book->save();
    }
    public function unlike(Book $book){
      $book->likes()->detach(Auth::id());
      $book->likes_count -= 1;
      $book->rating -= 5;
      $book->save();
    }
    public function read(Book $book){
      $book->reads()->syncWithoutDetaching([Auth::id()]);
      $book->reads_count += 1;
      $book->rating += 5;
      $book->save();
    }	
    public function view(Book $book)
    {
      Auth::user()->views()->syncWithoutDetaching([$book->id]);
      $book->authorized_views_count += 1;
      $book->rating += 1;
      $book->save();
    }
    public function download(Book $book)
    {
      Auth::user()->downloads()->syncWithoutDetaching([$book->id]);
      $book->authorized_downloads_count += 1;
      $book->rating += 5;
      $book->save();
    }
}
