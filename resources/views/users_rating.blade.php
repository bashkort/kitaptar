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
                      @foreach(\App\User::all()->sortBy(function($user){
                        return -$user->books->count();
                      }) as $user)
                      <tbody>
                        <tr>
                          @if($user->name != "Александр Батыргариев")
                          <th>{{ $user->name }}</th>
                          @else
                          <th>{{ "Неизвестный добавитель" }}</th>
                          @endif
                          <th>{{ $user->books->count() }}</th>
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
