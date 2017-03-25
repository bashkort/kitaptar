<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
class LikeController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function like(Book $book){

  }
}
