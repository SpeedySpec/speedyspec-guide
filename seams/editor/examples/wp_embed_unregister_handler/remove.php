<?php
// Removes a handler by ID and priority.
wp_embed_register_handler( 'guide', '#x#', '__return_empty_string', 5 );
wp_embed_unregister_handler( 'guide' );
$still = isset( $GLOBALS['wp_embed']->handlers[5]['guide'] );
wp_embed_unregister_handler( 'guide', 5 );
return array( $still, isset( $GLOBALS['wp_embed']->handlers[5]['guide'] ) );
