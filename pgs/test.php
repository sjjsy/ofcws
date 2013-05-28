<?php	include("../pg-header.php"); ?>


<h2>Test</h2>


<p>
	A page for testing...
</p>

<?php

	echo '<p><b>"Hello World!"</b> -said a PHP script</p>';

	include "../static/php/testfuncs.php";

	print_hello_world();
?>


<?php	include("../pg-footer.php"); ?>
