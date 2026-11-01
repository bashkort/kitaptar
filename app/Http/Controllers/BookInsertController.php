<?php

namespace App\Http\Controllers;
use App\Book;
use Illuminate\Support\Facades\File;
use App\Author;
use App\Http\Requests\CreateBookRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
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
      $count = 0;
      $alias = alias($request->name);
      $searches = Book::all();
      foreach($searches as $search){
          if(substr($search->alias, 0, strlen($alias)) == $alias){
 		$count++;
 	  }
      }
      if($count > 0) $book->alias = $alias . $count;
      else $book->alias = $alias;
      if($request->cover){
	$cover_name = substr($request->cover->store("public/covers"), 7);
      	$book->cover = $cover_name;
      	$preview_name = substr($request->cover->store("public/previews"), 7);
      	$book->preview = $preview_name;
      	$image = Image::make( Storage::disk('public')->get($preview_name) )->heighten(296)->stream();
      	$path = Storage::disk('public')->put("/$preview_name", $image);
      }
      else{
        $book->cover = "";
        $book->preview = "";
      }
      $book->language = $request->language;
      $book->redirect = 0;
	  $authors_names = trim(implode(", ", $request->authors));
      $book->authors_names = substr($authors_names, 0, strlen($authors_names) - 1);
      $book->authorized_views_count = 0;
      $book->authorized_downloads_count = 0;
      $book->unauthorized_views_count = 0;
      $book->unauthorized_downloads_count = 0;
      $book->likes_count = 0;
      $book->rating = 0;
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
          return view("upload/fail");
        };
      }
      $book->save();
	  foreach($request->authors as $author_name){
		if($author_name == ""){
			continue;
		}
		$exciting_author = Author::where("name", $author_name)->first();
		if($exciting_author !== null){
			$book->authors()->attach($exciting_author->id);
		}
		else{
			$author = new Author;
			$author->name = $author_name;
			$author->save();
			$book->authors()->attach($author->id);
		}
      }
      foreach($request->book_files as $num=>$book_file){
        $file = new \App\File;
        $file->active = True;
        $file->book_id = $book->id;
        $file->ext = $request->book_files[$num]->extension();
        $file->href = $book_file->store("public/books");
        if($file->ext == "zip"){
          $file->ext = "epub";
          Storage::move($file->href, $file->href . ".epub");
          $file->href = substr($file->href . ".epub", 7);
        }
        elseif($file->ext == "xml"){
          $file->ext = "fb2";
          Storage::move($file->href, $file->href . ".fb2");
          $file->href = substr($file->href . ".fb2", 7);
        }
        else{
          $file->href = substr($file->href, 7);
        }
        $file->save();
      }
      return redirect()->route("book_page", ['id' => $book->id]);
    }
}
