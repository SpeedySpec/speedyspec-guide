<?php
// No user is logged in here, and there is no user system: a stand-in current_user_can() says no, as WordPress does for a visitor.
function current_user_can( $capability ) {
	return false;
}
// Removes the filters kses_init_filters() added.
kses_init_filters();
kses_remove_filters();
return has_filter( 'content_save_pre', 'wp_filter_post_kses' );
