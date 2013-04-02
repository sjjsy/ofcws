<?php
	header( "Content-Type: application/rss+xml; charset=ISO-8859-1" );

	include "./static/php/basic.php";
	include "./static/php/ofc.php";

	$rssf = '<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">
	<channel>
		<title>The OFC Fight Feed</title>
		<description>The RSS feed of Otaniemi Fight Club.</description>
		<link>http://ofc.ayy.fi/</link>
		<lastBuildDate>Mon, 01 Apr 2013 19:10:00 +0200 </lastBuildDate>
		<pubDate>Mon, 01 Apr 2013 19:10:00 +0200 </pubDate>
		<ttl>1800</ttl>
		<item>
			<title>New web site launched!</title>
			<description>OFC\'s new AYY based web site got launched. Please share your comments at the Facebook group!</description>
			<link>http://ofc.ayy.fi/</link>
			<guid>1234</guid>
			<pubDate>Thu, 07 Feb 2013 22:00:00 +0200 </pubDate>
		</item>
	</channel>
</rss>';

	echo $rssf;
?>

