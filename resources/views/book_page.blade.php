@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                  <div class="panel-heading">
                  </div>
                <div class="panel-body">
                  <img class="img-thumbnail img-responsive pull-left book-cover"  src="/storage/{{ $book->cover }}">
                      <h1>{{  $book->name }}</h1>
                      <h3>{{  $book->authors }}</h3>
                    <br />
                    <p>{{ $book-> description }}
                    <table class="table table-hover">
                      @foreach($book->files as $file)
                      <tbody>
                        <tr>
                          <th>
                            <a href="/storage/{{ $file->href }}" download>
                              <button class="btn btn-primary" onclick="axios.post('/download/{{ $book->id }}');">{{ $file->ext  }}</button>
                            </a>
                            <span>
                              Добавлено: {{ $file -> created_at  }}
                            </span>
                          </th>
                        </tr>
                      </tbody>
                      @endforeach
                    </table>
                </div>
                @if (Auth::check())
          	    <div class="panel-footer">
                  <like
                      :book={{ $book->id }}
                      :liked={{ $book-> liked() ? 'true' : 'false' }}
                  ></like>{{ $book->likes->count()  }}
                  <i  class="fa fa-eye"></i>{{  $book->views->count() }}
                  <i  class="fa fa-download"></i>{{ $book->downloads->count()  }}
          	    </div>
                @endif
            </div>
          </div>
        </div>
      </div>

@endsection
@section('scripts')
<script type="text/javascript">
  $( document ).ready(axios.post('/view/{{ $book->id }}'));
</script>
@endsection
