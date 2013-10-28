<?php
  $thetitle = 'Photos | ';
  $vpfss    =  array();
  $vpfss[]  = '/static/css/photos.css';
  include( "../pg-header-a.php" );
?>


<div id="dphotos">

  <div id='dslider' class='swipe'>
    <div class='swipe-wrap'>
	    <?php
		    $a = '<div class="glrytrgt" style="background:url(../static/gfx/gallery/';
		    $b = ') center no-repeat; background-size:contain;"><span>';
		    $c = '</span></div>';
		    foreach ( gvnf( '../static/gfx/gallery/' ) as $indx => $nf )
		    {
			    print $a . $nf . $b . $c;  # ($indx + 1)

		    }
	    ?>
    </div>
  </div>

  <div id="dcontrols">
    <button type="button" class="btn btn-xs" onclick='glry.sldr.prev()'>prev</button> 
    <button type="button" class="btn btn-xs" onclick='glry.sldr.next()'>next</button>
  </div>

  <br/>

  <p>
    We at OFC prefer training to posing.
    Consequently we have very few photos to showcase.
    This is just something simple to offer <em>a tiny bit</em> of insight
    into what our trainings have looked like (some shots are pretty old).
    <!-- <a href="http://www.flickr.com/groups/otaniemifightclub/">
    </a> -->
    We <em>most humbly</em> ask you to stop browsing and
    start scheduling yourself a chance to
    check out the real deal at one of our events!
  </p>

  <p><a class="rtrn" href="/">Return</a></p>

</div>

<!-- <- SWIPE -->


<?php
  $vpfjs[] = '/static/js/swipe.js';
  $vpfjs[] = '/static/js/photos.js';
  include( "../pg-footer-a.php" );
?>
