



<?php

	function hide_email($email) { $character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz'; $key = str_shuffle($character_set); $cipher_text = ''; $id = 'e'.rand(1,999999999); for ($i=0;$i<strlen($email);$i+=1) $cipher_text.= $key[strpos($character_set,$email[$i])]; $script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipher_text.'";var d="";'; $script.= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));'; $script.= 'document.getElementById("'.$id.'").innerHTML="<a href=\\"mailto:"+d+"\\">"+d+"</a>"'; $script = "eval(\"".str_replace(array("\\",'"'),array("\\\\",'\"'), $script)."\")"; $script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>'; return '<span id="'.$id.'">[javascript protected email address]</span>'.$script; }

?>


<?php

	//
	// A PHP function to read Google Calendar entries.
	// Copyright (C) 2007  Antti Käenmäki
	// 
	// Inspired by:
	// http://simplepie.org/wiki/tutorial/grab_custom_tags_or_attributes
	// http://james.cridland.net/code/google-calendar.html
	// 
	// See also:
	// http://code.google.com/apis/calendar/developers_guide_php.html
	// 
	// This program is free software; you can redistribute it and/or
	// modify it under the terms of the GNU General Public License
	// as published by the Free Software Foundation.
	// 
	// This program is distributed in the hope that it will be useful,
	// but WITHOUT ANY WARRANTY; without even the implied warranty of
	// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	// GNU General Public License for more details.
	// 
	// You should have received a copy of the GNU General Public License
	// along with this program; if not, write to the Free Software
	// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
	// 

	// 
	// At the moment, recurring events won't work!
	// 

	//$document_root = "/home/antakae/www";  // you might want to use $_SERVER['DOCUMENT_ROOT'] here... (does not work for me)
	$simplepie_cache = "simplepie/cache";
	//require_once($document_root . "/function/simplepie/simplepie.inc");
	require_once("simplepie/simplepie.inc");


	function get_calendar_events(
	  $gmail,                      // the 'Calendar ID' code (as shown in your 'calendar settings')
	  $show_days = null,           // these are integers
	  $show_months = null,
	  $query_string = null,        // with this, it possible to perform a search
	  $charset = null,
	  $start_min = null,           // format is YYYY-MM-DD, where YYYY is year, MM month and DD day
	  $start_max = null,           // this overrides $show_* parameters
	  $max_results = null )
	{

	  // 
	  // Change this to 'true' to see lots of fancy debug code
	  // 
	  $debug_mode = false;

	  // 
	  // Error messages
	  // 
	  $WRONG_SIMPLEPIE_VERSION = "<p><b>Fatal error:</b> You need to be running SimplePie v1.0 or above for this to work.</p>";
	  $NO_CALENDAR = "<p><b>Fatal error:</b> You need to give the 'Calendar ID' code (as shown in your 'calendar settings' page)</p>";

	  // 
	  // Some configuration one might want to change.
	  // 
	  if (!isset($charset)) $charset = "ISO-8859-1";

	  // 
	  // The following determines how many days/months/years we want to show from now on.
	  // We shall receive $max_result latest added entries during this period. You might
	  // want to set $max_result very large.
	  // 
	  if (!isset($show_days))   $show_days = 21;
	  if (!isset($show_months)) $show_months = 0;
	  if (!isset($max_results)) $max_results = 999999;
	  if (!isset($start_min))   $start_min = date("Y-m-d");
	  list( $start_year, $start_month, $start_day ) = explode('-',$start_min,3);
	  if (!isset($start_max))   $start_max = date("Y-m-d",mktime(0, 0, 0, $start_month+$show_months, $start_day+$show_days, $start_year));

	  // 
	  // Use this string to make a search
	  // 
	  if (!isset($query_string)) $query_string = "";
	  else $query_string = "&q=" . urlencode($query_string);

	  // 
	  // Some sanity checks
	  // 
	  if (SIMPLEPIE_VERSION < 1) {
		 echo $WRONG_SIMPLEPIE_VERSION;
		 return false;
	  }
	  if (!isset($gmail)) {
		 echo $NO_CALENDAR;
		 return false;
	  }

	  // 
	  // A simple check to determine whether we have public or private calendar
	  // 
	  if (strpos($gmail,"/private-") === false && strpos($gmail,"/public") === false) $gmail = $gmail . "/public";
	  $calendar_xml_address = "http://www.google.com/calendar/feeds/" . $gmail 
		 . "/full?start-min=" . $start_min . "&start-max=" . $start_max 
		 . "&max-results=" . $max_results . $query_string;
	  
	  $feed = new SimplePie();
	  $feed->enable_cache(true);
	  //$feed->set_cache_location($simplepie_cache);  // ###Note to self: this does not seem to work###
	  if ($debug_mode) {
		 $feed->enable_cache(false);
		 echo "<pre>We are in debugging mode. The feed in use is <a href='$calendar_xml_address'>this</a>. We are not caching.</pre>";
	  }
	  $feed->set_feed_url($calendar_xml_address);
	  $feed->enable_order_by_date(false);  // we're just going to re-sort anyways
	  $feed->init();

	  foreach($feed->get_items() as $item) {

		 // Let's grab the Google-namespaced <gd:when> tag.
		 $gd_when = $item->get_item_tags('http://schemas.google.com/g/2005', 'when');
		 $start_time = $gd_when[0]['attribs']['']['startTime'];
		 $start_time = SimplePie_Misc::parse_date($start_time);
		 $end_time = $gd_when[0]['attribs']['']['endTime'];
		 $end_time = SimplePie_Misc::parse_date($end_time);
		 if (date("Y-m-d", $start_time) === date("Y-m-d", $end_time)) {
		   $type = "regular";
		 }
		 else {
		   $type = "all_day";
		   list($endH,$endi,$ends,$endm,$endd,$endY,$endI) = explode(",",date("H,i,s,m,d,Y,I",$end_time));
		   $end_time = mktime($endH,$endi,$ends,$endm,$endd-1,$endY,$endI);
		 }

		 // Let's grab the Google-namespaced <gd:where> tag.
		 $gd_where = $item->get_item_tags('http://schemas.google.com/g/2005', 'where');
		 $location = mb_convert_encoding( utf8_decode( $gd_where[0]['attribs']['']['valueString'] ), $charset );

		 // Let's grab the remaining stuff
		 $description = mb_convert_encoding( utf8_decode( $item->get_description() ), $charset );
		 $description = str_replace("\n","<br \>\n      ",$description);  // ###This shouldn't be hard-coded###
		 $title = mb_convert_encoding( utf8_decode( $item->get_title() ), $charset );
		 $link = $item->get_link();
		 $map = "http://maps.google.com/?q=" . urlencode($location);

		 $events[] = array( 'start_time'  => $start_time,
		                    'end_time'    => $end_time,
		                    'title'       => $title,
		                    'location'    => $location,
		                    'description' => $description,
		                    'link'        => $link,
		                    'map'         => $map,
		                    'type'        => $type );
	  }

	  // 
	  // Sort the events into start_time order
	  // 
	  sort($events);  // on a multidimensional array, the command "sort" will sort the first key, then the second and so on
	  reset($events);  // set the internal pointer of an array to its first element

	  if ($debug_mode) {
		 ini_set('default_socket_timeout', 120);
		 $xml = file_get_contents($calendar_xml_address);
		 if ($xml) {
		   echo "<pre>\n";
		   echo wordwrap(highlight_string($xml,true),80);
		   echo "\n</pre>\n";
		 }
	  }

	  return $events;
	}



	function print_calendar_events(
	  $events = null,
	  $theme = null,
	  $locale = null,
	  $dateformat = null,
	  $shortdateformat = null,
	  $timeformat = null,
	  $nouppercasedatename = null )
	{
	  // 
	  // Let's set the default values
	  // 
	  if (!isset($theme)) {
		 $types = array( "date", "time", "title", "location", "description" );
		 $html = array( 
		   array( 
		     "before"  => "\n<p>\n  <b>", 
		     "after"   => "</b>",
		     "ifempty" => "\n<p>" ),
		   array( 
		     "before"  => " | <i>", 
		     "after"   => "</i><br />\n",
		     "ifempty" => "<br />\n" ),
		   array( 
		     "before"  => "  <u>", 
		     "after"   => "",
		     "ifempty" => "  <u>" ),
		   array( 
		     "before"  => ", ", 
		     "after"   => "</u>\n</p>\n",
		     "ifempty" => "</u>\n</p>\n" ),
		   array( 
		     "before"  => "<p>\n  ", 
		     "after"   => "\n</p>\n",
		     "ifempty" => "" ) );
	  }
	  elseif ($theme === "ezorgs_essentials_theme") {
		 $types = array( "date", "time", "title", "location" );
		 $html = array(
		   array(
		     "before"  => "\n    <p>\n      <b>",
		     "after"   => "</b>",
		     "ifempty" => "\n    <p>\n" ),
		   array(
		     "before"  => " <span class=\"pdf\">",
		     "after"   => "</span><br />\n",
		     "ifempty" => "<br />\n" ),
		   array(
		     "before"  => "      <span class=\"indent\">",
		     "after"   => "</span><br />\n",
		     "ifempty" => "      <span class=\"indent\">Unavailable</span><br />" ),
		   array(
		     "before"  => "      <span class=\"indent\">",
		     "after"   => "</span>\n    </p>\n",
		     "ifempty" => "    </p>\n" ) );
	  }
	  elseif ($theme === "ezorgs_full_theme") {
		 $types = array( "date", "time", "title", "location", "description" );
		 $html = array(
		   array(
		     "before"  => "\n    <p>\n      <b>",
		     "after"   => "</b>",
		     "ifempty" => "\n    <p>\n" ),
		   array(
		     "before"  => " <span class=\"pdf\">",
		     "after"   => "</span><br />\n",
		     "ifempty" => "<br />\n" ),
		   array(
		     "before"  => "      <span class=\"indent\"><b>",
		     "after"   => "</b></span><br />\n",
		     "ifempty" => "      <span class=\"indent\">Unavailable</span><br />" ),
		   array(
		     "before"  => "      <span class=\"indent\">",
		     "after"   => "</span>\n    </p>\n",
		     "ifempty" => "    </p>\n" ),
		   array(
		     "before"  => "    <p class=\"indent\">\n      ",
		     "after"   => "\n    </p><br />\n",
		     "ifempty" => "" ) );
	  }
	  elseif ($theme === "nice_theme") {
		 $types = array( "date", "time", "title", "location", "description" );
		 $html = array(
		   array(
		     "before"  => "\n    <p>\n      <b>",
		     "after"   => "</b>",
		     "ifempty" => "\n    <p>\n" ),
		   array(
		     "before"  => " | <span class=\"pdf\">",
		     "after"   => "</span><br />\n",
		     "ifempty" => "<br />\n" ),
		   array(
		     "before"  => "      <span class=\"indent\">",
		     "after"   => "",
		     "ifempty" => "      <span class=\"indent\">Unavailable" ),
		   array(
		     "before"  => ", ",
		     "after"   => "</span>\n    </p>\n",
		     "ifempty" => "</span>\n    </p>\n" ),
		   array(
		     "before"  => "    <p class=\"indent\">\n      ",
		     "after"   => "\n    </p>\n",
		     "ifempty" => "" ) );
	  }
	  elseif ($theme === "title_date_description") {
		 $types = array( "title", "date", "description" );
		 $html = array(
		   array(
		     "before"  => "\n    <p>\n      <b>",
		     "after"   => "</b>",
		     "ifempty" => "\n    <p>\n" ),
		   array(
		     "before"  => " | <span class=\"pdf\">",
		     "after"   => "</span><br />\n    </p>\n",
		     "ifempty" => "<br />\n    </p>\n" ),
		   array(
		     "before"  => "    <p class=\"indent\">\n      ",
		     "after"   => "\n    </p>\n",
		     "ifempty" => "" ) );
	  }
	  elseif ($theme === "date_description") {
		 $types = array( "date", "description" );
		 $html = array(
		   array(
		     "before"  => "\n    <p>\n      <b>",
		     "after"   => "</b><br />\n",
		     "ifempty" => "\n    <p>\n" ),
		   array(
		     "before"  => "      <span class=\"indent\">",
		     "after"   => "</span>\n    </p>\n",
		     "ifempty" => "" ) );
	  }
	  elseif ($theme === "date_time_description") {
		 $types = array( "date", "time", "description" );
		 $html = array(
		   array(
		     "before"  => "\n    <p>\n      <b>",
		     "after"   => "</b>",
		     "ifempty" => "\n    <p>\n      <b>Unknown date</b>" ),
		   array(
		     "before"  => " | <span class=\"pdf\">",
		     "after"   => "</span>\n    </p>\n",
		     "ifempty" => "\n    </p>\n" ),
		   array(
		     "before"  => "    <p class=\"indent\">\n      ",
		     "after"   => "\n    </p>\n",
		     "ifempty" => "" ) );
	  }
	  else {  // isset($theme) && $theme != any theme defined above
		 $types = $theme('types');
		 $html = $theme('html');
	  }

	  // 
	  // Calendar events default to this   ###Note to self: missing link and map###
	  // 
	  if (!isset($events)) {
		 $events = array( array('start_time'  => mktime(0, 0, 0, date("m"), date("d"), date("Y")),
		                        'end_time'    => mktime(0, 0, 0, date("m"), date("d")+4, date("Y")),
		                        'location'    => "",
		                        'title'       => "This appointment is for five days",
		                        'description' => "",
		                        'type'        => "all_day" ), 
		                  array('start_time'  => mktime(date("H")+1, 0, 0, date("m"), date("d"), date("Y")),
		                        'end_time'    => mktime(date("H")+2, 0, 0, date("m"), date("d"), date("Y")),
		                        'location'    => "and it's in this location",
		                        'title'       => "This is for one hour",
		                        'description' => "These fake events are here just to making the adjustment of the appearance easier.  To see some real events, use the function get_calendar_events. If you just did that then probably your feed didn't contain any events.",
		                        'type'        => "regular" ) );
	  }

	  // 
	  // See http://www.php.net/strftime for details. Unset the $shortdateformat if you
	  // don't like "Monday, 4 - Friday, 8 September" type of notation.
	  // 
	  if (!isset($dateformat))      $dateformat = "%A, %e %B";
	  if (!isset($shortdateformat)) $shortdateformat = "%A, %e";
	  if (!isset($timeformat))      $timeformat = "%I:%M %p";
	  if (!isset($locale))          $locale = "en_US";
	  // 
	  // We have two special cases which also override user defined time and date formats
	  // 
	  else {
		 if ($locale === "en") {
		   $locale = "en_US";
		   $dateformat = "%A, %e %B";
		   $shortdateformat = "%A, %e";
		   $timeformat = "%I:%M %p";
		 }
		 elseif ($locale === "fi") {
		   $locale = "fi_FI";
		   $dateformat = "%A %e. %Bta";
		   $shortdateformat = "%A %e.";
		   $timeformat = "%H:%M";
		 }
	  }

	  if (!isset($nouppercasedatename)) $nouppercasedatename = FALSE;
	  else $nouppercasedatename = TRUE;

	  setlocale(LC_ALL, $locale);
	  $acceptable_types = array( "date", "time", "title", "location", "description", "link", "map" );

	  // 
	  // Check if given parameter contains only one event
	  // 
	  if (array_key_exists('start_time', $events) && array_key_exists('end_time', $events)) {
		 $events = array( $events );
	  }

	  // 
	  // The main loop
	  // 
	  foreach($events as $event) {
		 reset($types);
		 $type_pos = 0;
		 foreach($types as $type) {
		   if (!in_array($type, $acceptable_types)) continue;
		   //
		   // Print the date
		   //
		   if ($type === "date") {
		     if ($event['start_time']) {
		       if ($event['type'] == "all_day" && $event['end_time']) {
		         echo $html[$type_pos]["before"];
		         if ($event['start_time'] == $event['end_time']) {
		           if ($nouppercasedatename) echo strftime($dateformat,$event['start_time']);
		           else echo ucfirst(strftime($dateformat,$event['start_time']));
		         }
		         elseif (isset($shortdateformat) && strftime("%B",$event['start_time']) == strftime("%B",$event['end_time'])) {
		           if ($nouppercasedatename) echo strftime($shortdateformat,$event['start_time']);
		           else echo ucfirst(strftime($shortdateformat,$event['start_time']));
		           echo " - ";
		           echo strftime($dateformat,$event['end_time']);
		         }
		         else {
		           if ($nouppercasedatename) echo strftime($dateformat,$event['start_time']);
		           else echo ucfirst(strftime($dateformat,$event['start_time']));
		           echo " - ";
		           echo strftime($dateformat,$event['end_time']);
		         }
		         echo $html[$type_pos]["after"];
		       }
		       else {  // $event['type'] == "regular"
		         echo $html[$type_pos]["before"];
		         if ($nouppercasedatename) echo strftime($dateformat,$event['start_time']);
		         else echo ucfirst(strftime($dateformat,$event['start_time']));
		         echo $html[$type_pos]["after"];
		       }
		     }
		     else echo $html[$type_pos]["ifempty"];
		   }

		   //
		   // Print the time
		   //
		   elseif ($type === "time") {
		     if ($event['type'] == "regular" && $event['start_time']) {
		       echo $html[$type_pos]["before"];
		       echo strftime($timeformat,$event['start_time']);
		       echo " - ";
		       echo strftime($timeformat,$event['end_time']);
		       echo $html[$type_pos]["after"];
		     }
		     else echo $html[$type_pos]["ifempty"];
		   }

		   //
		   // Print the title
		   //
		   elseif ($type === "title") {
		     if ($event['title']) {
		       echo $html[$type_pos]["before"];
		       echo $event['title'];
		       echo $html[$type_pos]["after"];
		     }
		     else echo $html[$type_pos]["ifempty"];
		   }

		   //
		   // Print the the location
		   //
		   elseif ($type === "location") {
		     if ($event['location']) {
		       echo $html[$type_pos]["before"];
		       echo $event['location'];
		       echo $html[$type_pos]["after"];
		     }
		     else echo $html[$type_pos]["ifempty"];
		   }

		   //
		   // Print the description
		   //
		   elseif ($type === "description") {
		     if ($event['description']) {
		       echo $html[$type_pos]["before"];
		       echo $event['description'];
		       echo $html[$type_pos]["after"];
		     }
		     else echo $html[$type_pos]["ifempty"];
		   }

		   //
		   // Print the link
		   //
		   elseif ($type === "link") {
		     if ($event['link']) {
		       echo $html[$type_pos]["before"];
		       echo $event['link'];
		       echo $html[$type_pos]["after"];
		     }
		     else echo $html[$type_pos]["ifempty"];
		   }

		   //
		   // Print the map
		   //
		   elseif ($type === "map") {
		     if ($event['map']) {
		       echo $html[$type_pos]["before"];
		       echo $event['map'];
		       echo $html[$type_pos]["after"];
		     }
		     else echo $html[$type_pos]["ifempty"];
		   }

		   $type_pos = $type_pos + 1;
		 }
	  }
	}

?>




