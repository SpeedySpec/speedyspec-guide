<?php
// No user system here: a stand-in current_user_can() says no, as for a visitor, so kses is added to the save filters.
function current_user_can( $capability ) {
	return false;
}
kses_init();
return has_filter( 'content_save_pre', 'wp_filter_post_kses' );
