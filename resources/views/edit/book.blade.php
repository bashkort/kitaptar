@extends('layouts.app')

@section('content')
<div id="pattern" style="display:none">
  <div class="input-group">
      <input type="file" name="book_files[]" class="book_files" accept=".fb2,.epub,.txt,.doc,.docx,.pdf,.djvu" onchange="$('#inputs').append($('#pattern').html())"><br />
  </div>
</div>
<div id="authors_pattern"  style="display:none">
	<input id="authors" type="text" class="form-control" name="authors[]" oninput="$('#authors_div').append($('#authors_pattern').html()); this.oninput=''">
</div>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Редактировать книгу с id {{ $book->id }}</div>
          <div class="panel-body">
            <form role="form" action="/edit/book/{{ $book->id }}" method="post" enctype="multipart/form-data" class="form-horizontal" >
              {{  csrf_field()  }}
              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name" class="col-md-4 control-label">Название книги</label>

                  <div class="col-md-6">
                      <input id="name" type="text" class="form-control" name="name" value="{{ $book->name }}" required autofocus>

                      @if ($errors->has('name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>
              <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                  <label for="description" class="col-md-4 control-label">Описание книги</label>

                  <div class="col-md-6">
                      <textarea id="description" rows="5" class="form-control" name="description" required autofocus>{{ $book->description }}</textarea>

                      @if ($errors->has('description'))
                          <span class="help-block">
                              <strong>{{ $errors->first('description') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>
              <div class="form-group{{ $errors->has('authors') ? ' has-error' : '' }}">
                  <label for="authors" class="col-md-4 control-label">Имена авторов, через запятую</label>

                  <div class="col-md-6" id="authors_div">
					  @foreach($book->authors as $author)
						<input id="authors" type="text" class="form-control" name="authors[]" value="{{ $author->name }}"> 
					  @endforeach
					  <input id="authors" type="text" class="form-control" name="authors[]" oninput="$('#authors_div').append($('#authors_pattern').html()); this.oninput=''">

                      @if ($errors->has('authors'))
                          <span class="help-block">
                              <strong>{{ $errors->first('authors') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>
              <div class="form-group{{ $errors->has('book_files') ? ' has-error' : '' }}">
                  <label for="book_files" class="col-md-4 control-label">Добавить файлы<br>(Удаление на странице книги)</label>

                  <div class="col-md-6" id="inputs">
                      <div class="input-group">
                        <div class="input-group">
                            <input type="file" name="book_files[]" class="book_files" accept=".fb2,.epub,.txt,.doc,.docx,.pdf,.djvu" onchange="$('#inputs').append($('#pattern').html()); this.onchange=''"><br />
                        </div>
                      </div>
                      @if ($errors->has('book_files'))
                          <span class="help-block">
                              <strong>{{ $errors->first('book_files') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>
              <div class="form-group{{ $errors->has('cover') ? ' has-error' : '' }}">
                  <label for="cover" class="col-md-4 control-label">Заменить обложку</label>

                  <div class="col-md-6">
                      <div class="input-group">
                        <label class="input-group-btn">
                          <span class="btn btn-primary">
                            Browse&hellip; <input type="file" name="cover" id="cover" style="display: none;" accept="image/*">
                          </span>
                        </label>
                        <input type="text" class="form-control" readonly>
                      </div>
                      @if ($errors->has('cover'))
                          <span class="help-block">
                              <strong>{{ $errors->first('cover') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>
              <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">
                  <label for="language" class="col-md-4 control-label">Язык</label>

                  <div class="col-md-6">
                    <select class="form-control" id="language" name="language">
                      <option>Русский</option>
                      <option>Башкирский</option>
                      <option>Английский</option>
                      <option>Татарский</option>
                    </select>
                      @if ($errors->has('language'))
                          <span class="help-block">
                              <strong>{{ $errors->first('language') }}</strong>
                          </span>
                      @endif
                    <span class="help-block">Текущий язык - {{ $book->language }}</span>
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                      <button type="submit" class="btn btn-primary">
                          Отправить
                      </button>
                  </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
  @section('scripts')
    <script>
    $(function() {

      // We can attach the `fileselect` event to all file inputs on the page
      $(document).on('change', '#cover', function() {
        var input = $(this),
          numFiles = input.get(0).files ? input.get(0).files.length : 1,
          label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
          input.trigger('fileselect', [numFiles, label]);
        });

        // We can watch for our custom `fileselect` event like this
        $(document).ready( function() {
          $(':file').on('fileselect', function(event, numFiles, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;

            if( input.length ) {
              input.val(log);
            } else {
            if( log ) alert(log);
            }

          });
        });

      });
    </script>
@endsection
