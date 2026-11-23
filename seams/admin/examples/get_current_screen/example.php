<?php
// The current admin screen as a WP_Screen, or null before it is set.
set_current_screen( 'edit-page' );
$screen = get_current_screen();
return array( $screen->id, $screen->base, $screen->post_type );
