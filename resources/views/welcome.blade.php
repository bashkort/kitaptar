@extends('layouts.app')
@section('styles')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <header>
                  <div id="search-box"></div>
                  </header>
                </div>

                <div class="panel-body">
                  <main>
                    <div id="right-column">
                      <div id="stats"></div>
                      <div id="hits"></div>
                      <div id="pagination"></div>
                    </div>
                  </main>
                </div>
            </div>
          </div>
        </div>
      </div>

@endsection
@section('scripts')
<script type="text/html" id="hit-template">
    <div class="hit">
      <div class="hit-image">
        <img src="/storage/@{{preview}}" alt="@{{name}}" onerror="this.src='/img/default_cover.png'">
      </div>
      <div class="hit-content">
        <a href="/book/@{{ objectID }}">
	<h2 class="hit-name">@{{{_highlightResult.name.value}}}</h2></a><br />
        <h4 class="hit-name">@{{{_highlightResult.authors_names.value}}}</h2><br />
        <p class="hit-description">@{{{_highlightResult.description.value}}}</p>
      </div>
    </div>
  </script>

  <script type="text/html" id="no-results-template">
    <div id="no-results-message">
      <p>Нет результатов по запросу <em>"@{{query}}"</em>.</p>
      <a href="." class='clear-all'>Очистить поиск</a>
    </div>
  </script>
<script src="https://cdn.jsdelivr.net/npm/instantsearch.js@2.2.4/dist/instantsearch.min.js"></script>
<script src="{{ asset('js/search.js') }}"></script>
@endsection
