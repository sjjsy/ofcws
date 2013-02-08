<?php	include("../pg-header.php"); ?>


<h2>Boards</h2>
<?php
	/*
	Puheenjohtaja
	Bosco Martinez

	Varapuheenjohtaja
	Sami Pekkala

	Sihteeri
	Ville Touronen

	Rahastonhoitaja
	Olli Penttilä

	Muut jäsenet
	Tuomo Kuusisto
	Tero Kalliokorpi
	Joonas Järvi
	Janne Salonkangas
	*/

	function list_board( $board ) 
	{
		foreach ($board as $value)
		{
			print $value;
		}
	}


	function list_boards() 
	{
		// create an array to hold the data
		$board = [
			 "foo" => "bar",
			 "bar" => "foo",
		];

		list_board( $board );

		// done!
		return;
	}

?>

<h4>2013</h4>

<ul class="unstyled">
	<li><b>President</b>: Samuel Marisa</li>
	<li><b>Treasurer</b>: Bosco Martinez</li>
	<li><b>Secretary</b>: Ville Sorsa</li>
	<li>Other Members of the Board:
		<ul style="list-style:none;">
			<li>Mikko Salama</li>
			<li>Heikki Jussila</li>
		</ul>
	</li>
</ul>


<h4>2012</h4>

<ul class="unstyled">
	<li><b>President</b>: Ville Sorsa</li>
	<li><b>Treasurer</b>: Juho Leinonen</li>
	<li><b>Secretary</b>: Sami Pekkala</li>
	<li>Other Members of the Board:
		<ul style="list-style:none;">
			<li>Heikki Jussila</li>
		</ul>
	</li>
</ul>


<?php	include("../pg-footer.php"); ?>
