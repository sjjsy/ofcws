



<?php

  function list_boards()
  {
    // create an array to hold the data
    $years  = array( "2013", "2012", "2010" );
    $posts  = array( "President", "Vice President", "Treasurer", "Secretary" );
    $oposts = array( "Inspector" );

    $boards = array(
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
      "2010" => array(
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
          echo '<li><strong>' . utf8_decode( $boards[$year][$post] ) . '</strong><br/><small>(' . $post . ')</small></li>';
        }
      }
      if ( isset( $boards[$year]['Other'] ) )
      {
        echo '<br/>';
        foreach ( $boards[$year]['Other'] as $member )
        {
          echo '<li><strong>' . utf8_decode( $member ) . '</strong></li>';
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
