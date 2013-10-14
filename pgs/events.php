<?php	include("../pg-header.php"); ?>


<h2>Events</h2>


<p>
	Below is a listing of the upcoming events from our event schedule. However, it
	doesn't repeat recurring events which for this fall are: "wrestling" on
	Mondays & "kickboxing" for Wednesdays and Saturdays.
</p>

<p>
	You may subscribe to the calendar's XML feed directly using <a href="https://www.google.com/calendar/feeds/m8540j7mbg1akg32rvhfb6uir4%40group.calendar.google.com/public/basic">this link</a>.
</p>

<!--
<p>
	We also have
	<a href="/feed/rss.xml" title="The OFC Fight Feed" type="application/rss+xml">
		an RSS feed
	</a>
	to which you can subscribe in order to follow the latest news.
</p>-->

<p>
   All that said, this website is designed to be a rather static source of information. The
	<a href="http://www.facebook.com/groups/107657179302080/">Facebook group</a>
	and <a href="http://otaniemifightclub.nimenhuuto.com/">Nimenhuuto</a>
   services offer the most up-to-date and valid information.
</p>

<h3>Upcoming Events</h3>

<?php
	$events = get_calendar_events( 'm8540j7mbg1akg32rvhfb6uir4@group.calendar.google.com', null, null, null, "ISO-8859-1", null, null, 12 );

	print_calendar_events( $events, "ezorgs_full_theme", null, "%Y-%m-%d", "%m-%d", "%H:%M" );
?>


<?php	include("../pg-footer-a.php"); ?>
