<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
class ReaderController extends Controller
{
    public function __construct(){
	$this->middleware("auth");
    }

    public function showReader(File $file){
	$data = array(
	    "file" => $file,
	    "book" => $file->book
	);
	return view("pages/contained", $data);	
    }
}
