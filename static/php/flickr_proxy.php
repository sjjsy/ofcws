<?

  // requested page
  $npcpp = array_key_exists('npcpp', $_GET)  ? $_GET['npcpp'] : 10;
  $pg    = array_key_exists(   'pg', $_GET)  ? $_GET[   'pg'] :  1;

  // include the phpFlickr library
  require_once('lib/phpFlickr/3.2/phpFlickr.php');

  // create an instance of the phpFlickr class
  $f = new phpFlickr('4071a364cffdf5dbd010a7eeb131bf50');

  // Caching
  $f->enableCache("fs", "/home/ofc/www-data/cache");

  // fetch photos from the group    array('warmup','kickboxing')
  $resp = $f->groups_pools_getPhotos('2405618@N22', NULL, NULL, NULL, 'path_alias', $npcpp, $pg);

  $output = array(
    'total'   => $resp['photos']['total'],
    'perPage' => $resp['photos']['perpage'],
    'pages'   => $resp['photos']['pages'],
    'page'    => $resp['photos']['page'],
    'photos'  => array()
  );

  foreach ( (array) $resp['photos']['photo'] as $photo ) {
    if ( $photo['pathalias'] ) {
      $node = array(
        'src' => $f->buildPhotoURL( $photo, 'small' ),
        'url' => 'http://www.flickr.com/photos/' . $photo['pathalias'] . '/' . $photo['id']
      );
      array_push( $output['photos'], $node );
    }
  }

  header('Content-type: application/json');
  echo json_encode( $output );


?>
