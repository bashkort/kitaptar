<?php

namespace App\Http\Controllers;
use App\Book;
use App\File;
use App\Http\Requests\CreateBookRequest;
use Illuminate\Support\Facades\Auth;

class BookInsertController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    public function show_form()
    {
      return view("add_book");
    }
    public function add_book(CreateBookRequest $request)
    {
      $book = new Book;
      $book->name = $request->name;
      $book->cover = substr($request->cover->store("public/covers"), 7);
      $book->language = $request->language;
      $book->authors = $request->authors;
      $book->adder_id = Auth::user()->id;
      $book->active = True;
      $book->description = $request->description;
      for($i = 0; $i < count($request->book_files); $i++){
        try {
          $extension = $request->book_files[$i]->extension();
        } catch (Exception $e) {
          return view("upload/fail");
        }

        if (!in_array($extension, ["fb2", "epub", "txt", "doc", "docx", "pdf", "zip", "xml", "djvu"])){
          echo "Проблемный файл с расширением: $extension <br>";
          return view("upload/fail");
        };
      }
      $book->save();
      foreach($request->book_files as $num=>$book_file){
        $file = new File;
        $file->book_id = $book->id;
        $file->href = substr($book_file->store("public/books"), 7);
        $file->ext = $request->book_files[$num]->extension();
        $file->save();
      }
      return redirect()->route("book_page", ['id' => $book->id]);
    }
}
