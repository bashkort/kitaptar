
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                  <div class="panel-heading">
                  </div>
                <div class="panel-body">
                      <h1>{{  $author->name }}</h1>
                    <br />
                    <table class="table table-hover">
                      @foreach($author->books as $book)
                      <tbody>
                        <tr>
                          <th>
				<a href="/book/{{ $book->id }}">{{ $book->name }}</a>
                          </th>
                      </tbody>
                      @endforeach
                    </table>
                </div>
            </div>
          </div>
        </div>
      </div>

@endsection
@section('scripts')
@endsection
