$(document).ready(function() {

  console.log( 'Enjoy the photos!' );

  // create a namespace, glry, if it doesn't exist
  window.glry = window.glry || {};

  // add a swipe2 slider
  window.glry.sldr = $('#dslider').Swipe().data('Swipe');

});




// EOF
