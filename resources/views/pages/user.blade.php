
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                  <div class="panel-heading">
                  </div>
                <div class="panel-body">
                      <h1>{{  $user->name }}</h1>
                    <br />
                    <h2>Всего загружено книг: {{ $user->books->count() }}</h2><br />
                    @if(Auth::user()->role->name == "Redactor")
                    <table class="table table-hover">
                      @foreach($user->books as $book)
                      <tbody>
                        <tr>
                          <th>
				<a href="/book/{{ $book->id }}">{{ $book->name }}</a>
                          </th>
                      </tbody>
                      @endforeach
                    </table>
                    @endif
                </div>
            </div>
          </div>
        </div>
      </div>

@endsection
@section('scripts')
@endsection
