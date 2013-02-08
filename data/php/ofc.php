



<?php

	function list_boards()
	{
		// create an array to hold the data
		$years = array( "2013", "2012", "2010" );
		$posts = array( "President", "Vice President", "Treasurer", "Secretary" );

		$boards = array(
			"2013" => array(
				"President" => "Samuel Marisa",
				"Treasurer" => "Bosco Martinez",
				"Secretary" => "Ville Sorsa",
				"Other" => array( "Mikko Salama", "Heikki Jussila" ),
			),
			"2012" => array(
				"President" => "Ville Sorsa",
				"Treasurer" => "Juho Leinonen",
				"Secretary" => "Sami Pekkala",
				"Other" => array( "Heikki Jussila" ),
			),
			"2010" => array(
				"President" => "Bosco Martinez",
				"Vice President" => "Sami Pekkala",
				"Treasurer" => "Olli Penttilä",
				"Secretary" => "Ville Touronen",
				"Other" => array( "Tuomo Kuusisto", "Tero Kalliokorpi", "Joonas Järvi", "Janne Salonkangas" ),
			)
		);

		foreach ($years as $year)
		{
			echo '<h4>' . $year . '</h4>';
			echo '<ul class="unstyled">';
			foreach ($posts as $post)
			{
				if ( $boards[$year][$post] != NULL )
				{
					echo '<li>' . $boards[$year][$post] . ' <span class="unimportant">(' . $post . ')</span></li>';
				}
			}
			if ( $boards[$year]['Other'] != NULL )
			{
				foreach ($boards[$year]['Other'] as $member)
				{
					echo '<li class="unimportant">' . $member . '</li>';
				}
			}
			echo '</ul>';
		}

		// done!
		return;
	}

?>




