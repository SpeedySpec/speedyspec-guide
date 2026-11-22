<?php
// Removes registered default header images.
register_default_headers( array( 'sky' => array( 'url' => 'a', 'thumbnail_url' => 'b' ), 'sea' => array( 'url' => 'c', 'thumbnail_url' => 'd' ) ) );
unregister_default_headers( 'sky' );
return array_keys( $GLOBALS['_wp_default_headers'] );
