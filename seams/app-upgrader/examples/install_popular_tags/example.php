<?php
// The popular plugin tags from the Plugins API, cached for three hours.
guide_queue_http( array( array( 'widget' => array( 'name' => 'widget', 'slug' => 'widget', 'count' => 5000 ) ) ) );
$tags = install_popular_tags();
$cached = install_popular_tags();
return array( array_keys( (array) $tags ), $cached == $tags );
