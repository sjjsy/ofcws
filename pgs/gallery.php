<?php
  $thetitle = 'Gallery | ';
  $vpfss    =  array();
  $vpfss[]  = '/static/css/gallery.css';
  include( "../pg-header-a.php" );
?>


<div id="dgallery">

  <h1>
    Gallery
  </h1>


  <div id="dcontrols">
    <button type="button" class="btn btn-xs" onclick='glry.flckr.prev()'>prev</button> 
    <button type="button" class="btn btn-xs" onclick='glry.flckr.next()'>next</button>

    <div id="dmatrixnfo">
      <p>...</p>
    </div>

    <p class="loader">
      Waiting for Flickr...
    </p>
  </div>

  <div id="dmatrix">
  </div>

  <div class="clear">
  </div>

</div>


<?php
  $vpfjs[] = '/static/js/gallery.js';
  include( "../pg-footer-a.php" );
?>
