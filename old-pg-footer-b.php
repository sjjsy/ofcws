        </div>

        <!--
          right bar
        -->

        <div id="theright" class="col-md-3">

          <div class="panel panel-default">

            <h3>Calendar</h3>

            <?php
              $events = get_calendar_events('m8540j7mbg1akg32rvhfb6uir4@group.calendar.google.com', 90, null, null, "UTF-8", null, null, 6);

              print_calendar_events($events, "ezorgs_essentials_theme", null, "%Y-%m-%d", "%m-%d", "%H:%M");
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
