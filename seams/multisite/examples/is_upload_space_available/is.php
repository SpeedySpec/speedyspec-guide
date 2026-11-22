<?php
// Whether a site has upload space left (always, with the quota check off).
update_option( 'blog_upload_space', 5 );
function guide_space_used( $space_used ) {
	return 6;
}
add_filter( 'pre_get_space_used', 'guide_space_used' );
return is_upload_space_available();
