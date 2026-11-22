<?php
// Clears a site's cached details and fires refresh_blog_details.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
function guide_print_refresh_blog_details( $id ) {
	echo "refresh_blog_details $id\n";
}
add_action( 'refresh_blog_details', 'guide_print_refresh_blog_details' );
refresh_blog_details( $site );
return 'refreshed';
