<?php
// No user is logged in here, and there is no user system: a stand-in current_user_can() says no, as WordPress does for a visitor.
function current_user_can( $capability ) {
	return false;
}
// Adds kses to the filters that save titles, content, excerpts and comments; comments get the stricter list unless the user may post unfiltered HTML.
kses_init_filters();
return array( has_filter( 'content_save_pre', 'wp_filter_post_kses' ), has_filter( 'pre_comment_content', 'wp_filter_kses' ) );
