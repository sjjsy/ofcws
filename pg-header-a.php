<?php
  header( 'Content-Type:text/html; charset=utf-8' );
  $thetitle = '';
  $vpfjs = array();
  include 'static/php/basic.php';
  include 'static/php/ofc.php';
?>
<!DOCTYPE html>

<html>

  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Otaniemi Fight Club,Otaniemi,Fight,Club,martial arts,martial,wrestling,submission wrestling,submission,kickboxing,kick,boxing,mixed martial arts,MMA,Brazilian jiu-jitsu,karate,self-defense,sports,exercise,Aalto,University,student,association,Espoo,Helsinki,Finland,paini,mattopaini,nyrkkeily,potkunyrkkeily,kamppailu,thainyrkkeily,itsepuolustus,urheilu" />
    <meta name="description" content="Otaniemi Fight Club's official website." />
    <meta name="author" content="azcorbin (hit me!) gmail.com" />

    <title><?php echo $thetitle; ?>Otaniemi Fight Club</title>

    <link rel="shortcut icon" href="/favicon.png" />
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/static/css/ofc.css" />

    <?php if ( isset( $vpfss ) ) {  foreach ( $vpfss as $pfss ) {  echo '<link rel="stylesheet" href="' . $pfss . '">';  }  } ?>

    <link rel="alternate" href="/feed/rss.xml" title="The OFC Fight Feed" type="application/rss+xml" />

  </head>

  <body id="body">

    <!--
      the topmost bar
    -->

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Otaniemi Fight Club</a>
      </div>
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav pull-right">
          <?php include("pg-menu.php"); ?>
        </ul>
      </div>
    </nav>

    <div id="dmain">
