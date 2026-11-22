<?php
// A post's title for a feed, with tags stripped; filtered by the_title_rss.
$id = wp_insert_post( array( 'post_title' => 'Sencha <em>and</em> Matcha', 'post_status' => 'publish' ) );
return get_the_title_rss( $id );
