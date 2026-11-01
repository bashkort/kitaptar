@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#now">Читаю сейчас</a></li>
                    <li><a data-toggle="tab" href="#my">Загруженные мной</a></li>
                    <li><a data-toggle="tab" href="#viewed">Просмотренные</a></li>
                    <li><a data-toggle="tab" href="#liked">Понравившиеся</a></li>
                    <li><a data-toggle="tab" href="#downloaded">Скачанные</a></li>
                </ul>
                <div class="tab-content">
                    <div id="now" class="tab-pane fade in active panel panel-default">
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
                    <div id="my" class="tab-pane fade panel panel-default">
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
                    <div id="viewed" class="tab-pane fade panel panel-default">
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
                    <div id="liked" class="tab-pane fade panel panel-default">
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
                    <div id="downloaded" class="tab-pane fade panel panel-default">
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
    </div>
    </div>
@endsection
