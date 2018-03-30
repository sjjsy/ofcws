



<?php

  function list_boards()
  {
    // create an array to hold the data
    $years  = array("2018", "2017","2016", "2015", "2014", "2013", "2012", "2010-11" );
    $posts  = array( "President", "Vice President", "Treasurer", "Secretary", "Event Coordinator", "Marketing" );
    $oposts = array( "Inspector" );

    $boards = array(
      "2018" => array(
        "President"         => "Emil Mattsson",
        "Treasurer"         => "Sebastian Nikolov",
        "Secretary"         => "Mikko Syrjälä",
        "Inspector"         => array( "Elias Mikkola", "Samuel Marisa" ),
      ),
      "2017" => array(
        "President"         => "Elias Mikkola",
        "Treasurer"         => "Samuel Marisa",
        "Secretary"         => "Jesse Miettinen",
        "Marketing"         => "Mikko Syrjälä",
        "Inspector"         => array( "Heikki Jussila" ),
      ),
      "2016" => array(
        "President"         => "Samuel Marisa",
        "Treasurer"         => "Heikki Jussila",
        "Secretary"         => "Tino Tuominen",
        "Inspector"         => array( "Bosco Martinez", "Loviisa Kataja" ),
      ),
      "2015" => array(
        "President"         => "Samuel Marisa",
        "Treasurer"         => "Jared Myren",
        "Secretary"         => "Jesperi Rantanen",
        "Event Coordinator" => "Tino Tuominen",
        "Marketing"         => "Heikki Jussila",
        "Inspector"         => array( "Bosco Martinez", "Loviisa Kataja" ),
      ),
      "2014" => array(
        "President"         => "Samuel Marisa",
        "Treasurer"         => "Ville Sorsa",
        "Secretary"         => "Tino Tuominen",
        "Event Coordinator" => "Jani Fellman",
        "Marketing"         => "Heikki Jussila",
        "Other"             => array( "Mikko Salama" ),
        "Inspector"         => array( "Bosco Martinez", "Sami Pekkala" ),
      ),
      "2013" => array(
        "President"      => "Samuel Marisa",
        "Treasurer"      => "Bosco Martinez",
        "Secretary"      => "Ville Sorsa",
        "Other"          => array( "Mikko Salama", "Heikki Jussila" ),
        "Inspector"      => "Sami Pekkala",
      ),
      "2012" => array(
        "President"      => "Ville Sorsa",
        "Treasurer"      => "Juho Leinonen",
        "Secretary"      => "Sami Pekkala",
        "Other"          => array( "Heikki Jussila" ),
      ),
      "2010-11" => array(
        "President"      => "Bosco Martinez",
        "Vice President" => "Sami Pekkala",
        "Treasurer"      => "Olli Penttilä",
        "Secretary"      => "Ville Touronen",
        "Other"          => array( "Tuomo Kuusisto", "Tero Kalliokorpi", "Joonas Järvi", "Janne Salonkangas" ),
      )
    );

    foreach ( $years as $year )
    {
      echo '<h4>' . $year . '</h4>';
      echo '<ul class="ul-unstyled">';
      foreach ( $posts as $post )
      {
        if ( isset( $boards[$year][$post] ) )
        {
          echo '<li><strong>' . $boards[$year][$post] . '</strong><br/><small>(' . $post . ')</small></li>';  # utf8_decode( )
        }
      }
      if ( isset( $boards[$year]['Other'] ) )
      {
        echo '<br/>';
        foreach ( $boards[$year]['Other'] as $member )
        {
          echo '<li><strong>' . $member . '</strong></li>';  # utf8_decode( )
        }
      }
      // TODO: listing oposts (the important nonboard people)
      echo '</ul>';
      echo '<br/>';
      echo '<br/>';
    }

    // done!
    return;
  }

?>
