@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Мои книги</div>

                <div class="panel-body">
                  <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Имя</th>
                          <th>Количество книг</th>
                        </tr>
                      </thead>
                      @foreach(\App\Author::all()->sortBy(function($author){
                        return -$author->books->count();
                      }) as $author)
                      <tbody>
                        <tr>
                          <th><a href="/author/{{$author->id}}">{{ $author->name }}</a></th>
                          <th>{{ $author->books->count() }}</th>
                        </tr>
                      </tbody>
                      @endforeach
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
