<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laravel\Scout\Searchable;

class Book extends Model
{
    use Searchable;

    public function liked()
    {
        return (bool)Like::where('user_id', Auth::id())
            ->where('book_id', $this->id)
            ->first();
    }

    public function files()
    {
        return $this->hasMany('App\File');
    }

    public function likes()
    {
        return $this->belongsToMany('App\User', 'likes');
    }

    public function reads()
    {
        return $this->belongsToMany('App\User', 'reads')->withPivot('page');
    }

    public function authorized_views()
    {
        return $this->belongsToMany('App\User', 'authorized_views');
    }

    public function authorized_downloads()
    {
        return $this->belongsToMany('App\User', 'authorized_downloads');
    }

    public function adder()
    {
        return $this->belongsTo('App\User');
    }

    public function authors()
    {
        return $this->belongsToMany('App\Author')->withTimestamps();
    }

    public function toSearchableArray()
    {
        $string = explode("/", $this->cover);
        array_shift($string);
        $cover_url = implode("/", $string);
        $files = array();
        foreach ($this->files as $file) {
            $files[] = array(
                "id" => $file->id,
                "href" => $file->href,
                "ext" => $file->ext,
            );
        }
        return array(
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "cover" => $this->cover,
            "preview" => $this->preview,
            "authors_names" => $this->authors_names,
            "language" => $this->language,
            "rating" => $this->rating,
            "cover_url" => $cover_url,
            "preview_url" => "https://kitaptar.bashkort.org/storage/$this->preview",
            "files" => $files,
            "active" => $this->active
        );
    }

    public function searchableAs()
    {
        return "books";
    }
}
