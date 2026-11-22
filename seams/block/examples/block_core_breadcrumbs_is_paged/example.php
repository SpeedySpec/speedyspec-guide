<?php
// Whether the page queried is past the first, for the Breadcrumbs block's page number item.
for ( $i = 1; $i <= 3; $i++ ) {
	wp_insert_post( array( 'post_title' => "Post $i", 'post_status' => 'publish' ) );
}
update_option( 'posts_per_page', 1 );
guide_go( '/' );
$first = block_core_breadcrumbs_is_paged();
guide_go( '/?paged=2' );
return array( $first, block_core_breadcrumbs_is_paged() );
