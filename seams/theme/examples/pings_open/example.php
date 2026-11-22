<?php
// Whether a post accepts pings; filtered by pings_open.
$id = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
return pings_open( $id );
