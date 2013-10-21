<?php $thetitle='Gallery | '; include("../pg-header-a.php"); ?>


<!--
	main content wrapper
-->

<div class="container">

	<div align="center">
		<h1>Gallery</h1>
		<p><a style="color: white;" href="/">Return</a></p>
	</div>

	<br>
	<br>

	<div align="center" style="background:#111;padding:10%;">

		<ul class="ul-unstyled">

			<?php

				function getFSIS( $directory ) 
				{

					// create an array to hold directory list
					$results = array();

					// create a handler for the directory
					$handler = opendir($directory);

					// open directory and walk through the filenames
					while ($file = readdir($handler)) {

						// if file isn't this directory or its parent, add it to the results
						if ($file != "." && $file != "..") {
							$results[] = $file;
						}

					}

					// tidy up: close the handler
					closedir($handler);

					// done!

          return $results;
				}

				$a = "<li><div align=\"center\"><img src=\"/static/gfx/gallery/";
				$b = "\" width=\"100%\" /></div></li><br>";

				foreach (getFSIS( "../static/gfx/gallery/" ) as $value)
				{
					print $a . $value . $b;
				}

			?>

		</ul>

		<div style="width: 60%; color: #AAA;">
  		<h3>PS.</h3>
		  <p>
		    Hopefully these gave you some insight into what our trainings have looked like in the past (some shots are very old).
		  </p>
		  <p>
		    We at OFC prefer training to posing.
		    Consequently we have very few photos off of our trainings.
		    Please come to see the real deal at one of our events!
		  </p>
	  </div>

	  <br>
	  <br>

		<p><a style="color: white;" href="/">Return</a></p>

	</div>

	<br>
	<br>

</div>


<?php include("../pg-footer-a.php"); ?>
