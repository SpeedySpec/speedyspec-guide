<?php
// Sets the current site's last_updated to now and fires wpmu_blog_updated.
function guide_print_wpmu_blog_updated( $id ) {
	echo "wpmu_blog_updated $id\n";
}
add_action( 'wpmu_blog_updated', 'guide_print_wpmu_blog_updated' );
wpmu_update_blogs_date();
return get_site()->last_updated !== '2026-03-01 09:00:00';
