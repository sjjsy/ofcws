        </div>

        <!--
          right bar
        -->

        <div id="theright" class="col-md-2">

          <div class="panel panel-default">

            <h3>Calendar</h3>

            <?php
              $events = get_calendar_events( 'm8540j7mbg1akg32rvhfb6uir4@group.calendar.google.com', null, null, null, "ISO-8859-1", null, null, 8 );

              print_calendar_events( $events, "ezorgs_essentials_theme", null, "%Y-%m-%d", "%m-%d", "%H:%M" );
            ?>

            <p>
              Note that recurring events such as the weekly training
              sessions aren't repeated in the list. See the
              <a href="/pgs/events.php">events page</a> for more
              information.
            </p>

          </div>

        </div>

      </div>

    </div>
