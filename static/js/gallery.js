$(document).ready(function() {

  console.log( 'Enjoy the gallery!' );

  // create a namespace, glry, if it doesn't exist
  window.glry = window.glry || {};

  // create a self-executing function (module)
  window.glry.flckr = function()
  {
    // private members
    var el, eln, ajaxLoader, ipage = 1, npages = -1, npctt = 0, npcpp = 0;

    // init function, we'll expose it publicly
    function _init() {

      // container references
      el          = $('#dmatrix');
      eln         = $('#dmatrixnfo');
      ajaxLoader  = $('.loader');

      npcpp = Math.floor( ($( window ).width() * 0.90) / 340 ) * Math.floor( ($( window ).height() * 0.90 - 200) / 260 );
      console.log( 'ddd: ' + $( window ).width() + '  ' + $( window ).height() );
      console.log( 'npcpp: ' + npcpp );
      if ( npcpp <= 4 ) { npcpp = 12; }

      // detect ajax calls at the document level in
      // order to show & hide busy icon and photo results
      $(document).bind( 'ajaxSend', function() {
        // show loading icon
        ajaxLoader.fadeTo( 'fast', 1 );
        // hide old results
        eln.fadeTo ( 'fast', 0 );
        el.fadeTo  ( 'fast', 0 );
      }).bind( 'ajaxComplete', function() {
        // hide loading icon
        ajaxLoader.fadeTo( 'slow', 0 );
        // show new results
        eln.fadeTo ( 'fast', 1 );
        el.fadeTo  ( 'fast', 1 );
      });

      // load initial view
      load( ipage );
    }

    // calls local proxy to retrieve flickr data for the selected type
    function load( pg ) {
      console.log( 'load:' + pg + ' ' + npages );
      if ( ( npages == -1 ) || ( ( npages >= 0 ) && ( (0 < pg) && (pg <= npages) ) ) ) {
        ipage = pg;
        $.get(
          '/static/php/flickr_proxy.php',
          {npcpp: npcpp, pg: pg},
          onSuccess
        );
      }
    }

    // appends the returned html to the container
    function onSuccess( json )
    {
      console.log( json );
      var data = eval( json );
      var photo, html, htmln;

      ipage  = data.page;
      npages = data.pages;

      if ( npages > 0 )
      {
        htmln = ''
        + '<p>'
        +   ipage + ' / ' + npages
        + '</p>';

        html = '<ul>';
        for ( var i in data.photos )
        {
          photo = data.photos[i];
          html += ''
            + '<li>'
            +   '<a href="' + photo.url + '" target="_blank">'
            +     '<img class="thumb" src="' + photo.src + '" />'
            +   '</a>'
            +  '</li>';
        }
        html += '</ul>';

        eln.html( htmln );
        el.html( html ); //.fadeTo( 'slow', 1 );
      }
      else
      {
        eln.html( '...' );
        el.html( '<center><p>Sorry, but no luck finding pictures today! :(</p>'
          + '<p>You should be able to find them yourself from the club\'s'
          + '<a href="https://www.flickr.com/groups/otaniemifightclub/">Flickr group</a>.</p>'
          + '</center>' );
      }
    }

    // functions to be called by controls
    function _prev() {  load( ipage - 1 );  }
    function _next() {  load( ipage + 1 );  }

    // functions to be made available
    return {
      init: _init,
      prev: _prev,
      next: _next
    };

  }();

  // initializes the custom class
  window.glry.flckr.init();
});




// EOF
