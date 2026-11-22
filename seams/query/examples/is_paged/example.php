<?php
// Whether the main query is for a page beyond the first of a paginated view.
for ( $i = 0;
$i < 12;
$i++ ) { wp_insert_post( array( 'post_title' => "P$i", 'post_status' => 'publish' ) );
} guide_go( '/?paged=2' );
$second = is_paged();
guide_go( '/' );
return array( $second, is_paged() );
