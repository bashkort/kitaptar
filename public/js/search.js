
app({
  appId: 'D5PMFTLE8T',
  apiKey: 'e58b23282bf0ab9d4a7c961f267be78b',
  indexName: 'books'
});
var change = $('#search');
var page = $('#content');
var sidebar = $('#sidebar');
var header = $('#header');
function app(opts) {
  const search = instantsearch({
  appId: opts.appId,
  apiKey: opts.apiKey,
  indexName: opts.indexName,
  urlSync: true,
  searchParameters: {
    filters: 'active = 1'
  }

  });
  search.addWidget(
    instantsearch.widgets.searchBox({
      container: '#search-box',
      placeholder: 'Найти книгу',

    })
  );
  search.addWidget(
  	instantsearch.widgets.hits({
  		container: '#hits',
  		hitsPerPage: 5,
    templates: {
      item: getTemplate('hit'),
      empty: getTemplate('no-results')
    }
  	})
  	);
    search.addWidget(
      instantsearch.widgets.stats({
        container: '#stats'
      })
    );
    search.addWidget(
    instantsearch.widgets.pagination({
      container: '#pagination',
      scrollTo: '#search-box',
    })
  );
  search.start();
}
function getTemplate(templateName) {
  return document.getElementById(templateName + '-template').innerHTML;
}
function getHeader(title) {
  return '<h5>' + title + '</h5>';
}
