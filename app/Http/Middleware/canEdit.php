<?php

namespace App\Http\Middleware;

use Closure;
use \App\Book;
use Illuminate\Support\Facades\Auth;
class canEdit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $book = $request->route('book') ?? $request->route('file')->book;
        if(Auth::user()->role->id != 2 and $book->adder_id != Auth::user()->id){
          abort(403);
        }
        return $next($request);
    }
}
