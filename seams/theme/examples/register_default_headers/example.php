<?php
// Registers default header images a theme offers, by name with their URL and thumbnail.
register_default_headers( array( 'sky' => array( 'url' => '%s/sky.jpg', 'thumbnail_url' => '%s/sky-t.jpg', 'description' => 'Sky' ) ) );
return array_keys( $GLOBALS['_wp_default_headers'] );
