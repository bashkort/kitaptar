@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        @if (Auth::check() && Auth::user()->role->name == "Redactor" && !$book->active)
                            <div class="alert alert-warning">
                                Книга была удалена
                            </div>
                        @endif
                        <img class="img-thumbnail img-responsive pull-left book-cover"
                             src="/storage/{{  $book->cover }}"
                             onerror="this.src='https://kitaptar.bashkort.org/img/default_cover.png'">
                        @if(Auth::check() and (Auth::user()->role->name == "Redactor" or $book->adder_id == Auth::user()->id))
                            <h1>
                                ID: {{  $book->id }}
                            </h1>
                        @endif
                        <h1>
                            {{  $book->name }}
                        </h1>
                        @foreach($book->authors as $author)
                            <h3><a href="/author/{{ $author->id }}">{{  $author->name }}</a></h3>
                        @endforeach
                        <br/>
                        <p>{!! nl2br(e($book-> description))  !!}
                        <table class="table table-hover">
                            @foreach($book->files->filter(function($file){
                              return $file->active or (Auth::check() and Auth::user()->role->name == "Redactor");
                            }) as $file)
                                <tbody>
                                <tr>
                                    <th>
                                        <a href="/storage/{{ $file->href }}" download>
                                            <button class="btn btn-primary"
                                                    @if (Auth::check())
                                                    onclick="axios.post('/authorized_download/{{ $book->id }}');"
                                                    @else
                                                    onclick="axios.post('/unauthorized_download/{{ $book->id }}');"
                                                    @endif
                                            >{{ $file->ext  }}</button>
                                        </a>
                                        <span
                                                @if (!$file->active)
                                                style="color:red"
                                        @endif
                                        >
                              Добавлено: {{ $file -> created_at  }}
                            </span>
                                        @if(Auth::check() and (Auth::user()->role->name == "Redactor" or $book->adder_id == Auth::user()->id))
                                            @if ($file->active)
                                                <a href="/delete/file/{{ $file->id }}">
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                            @else
                                                <a href="/recover/file/{{ $file->id }}">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            @endif
                                        @endif

                                    </th>
                                </tr>
                                </tbody>
                            @endforeach
                            @foreach( $book->files->filter(function($file){
                          return $file->active and $file->ext == "epub";
                            }) as $file)
                                <tbody>
                                <tr>
                                    <th>
                                        <a href="/read/{{ $file->id }}">
                                            <button class="btn btn-primary"
                                                    @if( Auth::check() and \App\Read::where('book_id', $book->id)->where('user_id', Auth::user()->id)->count() == 0)
                                                    onclick="axios.post('/read/{{ $book->id }}');"
                                                    @endif
                                            >
                                                Уҡырға
                                            </button>
                                        </a>
                                    </th>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                        @if(Auth::check() && Auth::user()->role->name == "Redactor")
                            <form id="merge" role="form" action="#" method="get" enctype="multipart/form-data"
                                  class="form-horizontal"
                                  onsubmit="this.action='/mergeBooks/{{ $book->id }}/' + $('#id').val()">
                                <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">ID зависимой книги для
                                        слияния</label>

                                    <div class="col-md-6">
                                        <input id="id" type="text" class="form-control" name="id"
                                               value="{{ old('id') }}" required>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                      <strong>{{ $errors->first('id') }}</strong>
                                  </span>
                                        @endif
                                        <button type="submit" class="btn btn-primary">
                                            Объединить
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif

                        <div class="text-center">
                            <div class="fluid center" style="padding-bottom:60px;">
                                <h2 class="center">Был китап тураһында дуҫтарығыҙға һөйләгеҙ!</h2>
                                <span style="margin:0 auto; width: 180px; display: block;">
                            <a class="btn soc" id="vk"
                               onclick="Share.vkontakte('https://kitaptar.bashkort.org/book/{{$book->id}}','{{ $book->name }} | Китаптар.Bashkort','https://kitaptar.bashkort.org/storage/{{$book->cover}}','Башкирская электронная библиотека. Книги на башкирском языке, о башкирах и Башкортостане')">Вконтакте</a>
                            <a class="btn soc" id="fb"
                               onclick="Share.facebook('https://kitaptar.bashkort.org/book/{{$book->id}}','{{ $book->name }} | Китаптар.Bashkort','https://kitaptar.bashkort.org/storage/{{$book->cover}}','Башкирская электронная библиотека. Книги на башкирском языке, о башкирах и Башкортостане')">Facebook</a>
                            <a class="btn soc" id="tw"
                               onclick="Share.twitter('https://kitaptar.bashkort.org/book/{{$book->id}}', '{{ $book->name }} | Китаптар.Bashkort')">Твиттер</a>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        @if (Auth::check())
                            <like
                                    :book={{ $book->id }}
                                            :liked={{ $book-> liked() ? 'true' : 'false' }}
                            ></like>{{ $book->likes_count  }}
                        @endif
                        <i class="fa fa-eye"></i>{{  $book->authorized_views_count + $book->unauthorized_views_count }}
                        <i class="fa fa-download"></i>{{ $book->authorized_downloads_count + $book->unauthorized_downloads_count  }}
                        @if(Auth::check() && (Auth::user()->role->name == "Redactor" || $book->adder_id == Auth::user()->id))
                            <a href="/edit/book/{{ $book->id }}"><i class="fa fa-edit"></i></a>
                            @if($book->active)
                                <a href="/delete/book/{{ $book->id }}" style="float: right">
                                    <i class="fa fa-remove"></i> Удалить
                                </a>
                            @else
                                <a href="/recover/book/{{ $book->id }}" style="float: right">
                                    <i class="fa fa-plus"></i> Восстановить
                                </a>
                            @endif
                        @else
                            <a href="mailto:ildar@bashkort.org?subject=Ошибка в книге №{{$book->id}}"
                               style="float: right">
                                Сообщить об ошибке
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    @if (Auth::check())
        <script type="text/javascript">
            $(document).ready(axios.post('/authorized_view/{{ $book->id }}'));
        </script>
    @else
        <script type="text/javascript">
            $(document).ready(axios.post('/unauthorized_view/{{ $book->id }}'));
        </script>
    @endif
@endsection
