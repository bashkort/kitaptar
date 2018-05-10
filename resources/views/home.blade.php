@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
                <div class="panel-heading">Читаю сейчас</div>

                <div class="panel-body">
                  <table class="table table-hover">
                      @if (Auth::user()->reads->count())
                      <thead>
                        <tr>
                          <th>Название</th>
                          <th>Авторы</th>
                        </tr>
                      </thead>
                      @endif
                      @forelse(Auth::user()->reads->filter(function($book){ return $book->active == 1; }) as $book)
                      <tbody>
                        <tr>
                          <th><a href="/book/{{$book->id}}">{{ $book->name }}</a></th>
                          <th>{{ $book->authors_names }}</th>

                        </tr>
                      </tbody>
                      @empty
                        Вы не начали читать ни одну книгу
                      @endforelse
                  </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Мои книги</div>

                <div class="panel-body">
                  <table class="table table-hover">
                      @if (Auth::user()->downloads->count())
                      <thead>
                        <tr>
                          <th>Название</th>
                          <th>Авторы</th>
                        </tr>
                      </thead>
                      @endif
                      @forelse(Auth::user()->books->filter(function($book){ return $book->active == 1; }) as $book)
                      <tbody>
                        <tr>
                          <th><a href="/book/{{$book->id}}">{{ $book->name }}</a></th>
                          <th>{{ $book->authors_names }}</th>

                        </tr>
                      </tbody>
                      @empty
                        Книг еще не добавлено
                      @endforelse
                  </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Просмотренные книги</div>

                <div class="panel-body">
                  <table class="table table-hover">
                      @if (Auth::user()->views->count())
                      <thead>
                        <tr>
                          <th>Название</th>
                          <th>Авторы</th>
                        </tr>
                      </thead>
                      @endif
                      @forelse(Auth::user()->views->filter(function($book){ return $book->active == 1; }) as $book)
                      <tbody>
                        <tr>
                          <th><a href="/book/{{$book->id}}">{{ $book->name }}</a></th>
                          <th>{{ $book->authors_names }}</th>

                        </tr>
                      </tbody>
                      @empty
                        Вы еще не просматривали книги
                      @endforelse
                  </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Понравившиеся книги</div>

                <div class="panel-body">
                  <table class="table table-hover">
                      @if (Auth::user()->likes->count())
                      <thead>
                        <tr>
                          <th>Название</th>
                          <th>Авторы</th>
                        </tr>
                      </thead>
                      @endif
                      @forelse(Auth::user()->likes->filter(function($book){ return $book->active == 1; }) as $book)
                      <tbody>
                        <tr>
                          <th><a href="/book/{{$book->id}}">{{ $book->name }}</a></th>
                          <th>{{ $book->authors_names }}</th>

                        </tr>
                      </tbody>
                      @empty
                        Вы еще не добавляли книги в понравившиеся
                      @endforelse
                  </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Скачанные книги</div>

                <div class="panel-body">
                  <table class="table table-hover">
                      @if (Auth::user()->downloads->count())
                      <thead>
                        <tr>
                          <th>Название</th>
                          <th>Авторы</th>
                        </tr>
                      </thead>
                      @endif
                      @forelse(Auth::user()->downloads->filter(function($book){ return $book->active == 1; }) as $book)
                      <tbody>
                        <tr>
                          <th><a href="/book/{{$book->id}}">{{ $book->name }}</a></th>
                          <th>{{ $book->authors_names }}</th>

                        </tr>
                      </tbody>
                      @empty
                        Вы еще не скачивали книги
                      @endforelse
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
