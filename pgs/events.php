<?php	$thetitle='Events | '; include("../pg-header.php"); ?>


<h2>Events</h2>


<p>
	Below is a listing of some upcoming events from our event schedule. However, it
	doesn't <i>repeat</i> recurring events such as the weekly trainings.
</p>

<p>
  You may subscribe to the calendar's XML feed directly using
  <a href="https://www.google.com/calendar/feeds/m8540j7mbg1akg32rvhfb6uir4%40group.calendar.google.com/public/basic">this link</a>.
  Highly recommended!
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
  The club's
  <a href="http://www.facebook.com/groups/107657179302080/">Facebook group</a>
  is the place where all news and updates are first published and that's where
  the discussions occur so that's a very useful resource as well.
</p>

<h3>Upcoming Events</h3>

<?php
	$events = get_calendar_events( 'm8540j7mbg1akg32rvhfb6uir4@group.calendar.google.com', 90, null, null, "ISO-8859-1", null, null, 12 );

	print_calendar_events( $events, "ezorgs_full_theme", null, "%Y-%m-%d", "%m-%d", "%H:%M" );
?>


<?php	include("../pg-footer-a.php"); ?>
