<!DOCTYPE html>

<html>

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name="viewport" content="width=device-width" />
		<meta name="keywords" content="Otaniemi Fight Club,Otaniemi,Fight,Club,martial arts,martial,wrestling,submission wrestling,submission,kickboxing,kick,boxing,mixed martial arts,MMA,Brazilian jiu-jitsu,karate,self-defense,sports,exercise,Aalto,University,student,association,Espoo,Helsinki,Finland,paini,mattopaini,nyrkkeily,potkunyrkkeily,kamppailu,thainyrkkeily,itsepuolustus,urheilu" />
		<meta name="description" content="Otaniemi Fight Club's official website." />
		<meta name="author" content="azcorbin (t) gmail.com" />

		<title>Otaniemi Fight Club</title>

		<link rel="stylesheet" href="/static/css/bootstrap.css" />
		<link rel="stylesheet" href="/static/css/bootstrap.responsive.css" />
		<link rel="stylesheet" href="/static/css/mezzanine.css" />
		<link rel="stylesheet" href="/static/css/ofc.css" />
		<link rel="alternate" href="/feed/rss.xml" title="The OFC Fight Feed" type="application/rss+xml" />

		<script>
			<?php
				include "/static/php/basic.php";
				include "/static/php/ofc.php";
			?>
		</script>

	</head>

	<body id="body">

		<!--
			the topmost bar
		-->

		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
				<div class="container">

					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="/">Otaniemi Fight Club</a>

					<p class="tagline">A martial arts association that operates under the Student Union of Aalto University</p>

					<div class="nav-collapse">

						<ul class="nav pull-right">
							<?php include("pg-menu.php"); ?>
						</ul>

					</div>

				</div>
			</div>
		</div>

		<div id="dmain">
