<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Book;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
class TransportController extends Controller
{
    public function transport()
    {
	foreach(Book::all() as $book){
		$book->update();
	}
    }
}
