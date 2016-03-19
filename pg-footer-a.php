    </div>

    <nav class="navbar navbar-inverse navbar-fixed-bottom">
      <div style="text-align: center;">
        <small>
          Created 2013-02-07, Modified 2016-03-19 <br/>
          All Rights Reserved / Samuel Marisa / OFC
        </small>
      </div>
    </nav>

    <div id="javascripts">
      <script src="/static/js/jquery.min.js"></script>
      <script src="/static/js/bootstrap.min.js"></script>
      <script src="/static/js/ofc.js"></script>
      <?php
        foreach ( $vpfjs as $pfjs )
        {
          echo '<script src="' . $pfjs . '"></script>';
        }
      ?>
    </div>

  </body>

</html>
