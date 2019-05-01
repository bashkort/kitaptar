@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Книги</div>

                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Имя</th>
                                <th>Количество книг</th>
                            </tr>
                            </thead>
                            @foreach(\App\Book::all() as $book)
                                <tbody>
                                <tr
                                        @if (!$book->active)
                                        style="color:red"
                                        @endif
                                >
                                    <th>{{ $book->id }}</th>
                                    <th>{{ $book->name }}</th>
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
