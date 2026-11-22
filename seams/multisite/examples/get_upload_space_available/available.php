<?php
// The bytes of uploads a site has left, with the quota checked; everything when upload_space_check_disabled is on.
update_option( 'blog_upload_space', 5 );
function guide_space_used( $space_used ) {
	return 2;
}
add_filter( 'pre_get_space_used', 'guide_space_used' );
return get_upload_space_available();
