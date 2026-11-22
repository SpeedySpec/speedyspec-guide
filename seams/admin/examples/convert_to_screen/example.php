<?php
// A WP_Screen for a hook name or screen ID, for functions that take either.
$screen = convert_to_screen( 'edit-post' );
return array( get_class( $screen ), $screen->id, $screen->base, $screen->post_type );
