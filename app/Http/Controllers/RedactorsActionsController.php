<?php

namespace App\Http\Controllers;

use App\Book;

class RedactorsActionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkRole']);
    }

    public function mergeBooks(Book $mainBook, Book $depBook)
    {
        if ($depBook->active && $mainBook->active) {
            foreach ($depBook->files as $file) {
                $file->book_id = $mainBook->id;
                $file->save();
            }
            foreach ($depBook->likes() as $like) {
                $like->book_id = $mainBook->id;
            }
            foreach ($depBook->authorized_views() as $view) {
                $view->book_id = $mainBook->id;
            }
            foreach ($depBook->reads() as $read) {
                $read->book_id = $mainBook->id;
            }
            $depBook->redirect = $mainBook->id;
            $depBook->active = 0;
            $depBook->save();
            $mainBook->unauthorized_views_count += $depBook->unauthorized_views_count;
            $mainBook->authorized_views_count += $depBook->authorized_views_count;
            $mainBook->unauthorized_downloads_count += $depBook->unauthorized_downloads_count;
            $mainBook->authorized_downloads_count += $depBook->authorized_downloads_count;
            $mainBook->likes_count += $depBook->likes_count;
            $mainBook->reads_count += $depBook->reads_count;
            $mainBook->rating += $depBook->rating;
            $mainBook->save();
        }
        return redirect()->route("book_page", ['id' => $mainBook->id]);
    }
}
