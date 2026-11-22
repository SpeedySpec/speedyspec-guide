<?php
// A post type archive's feed URL; filtered by post_type_archive_feed_link.
register_post_type( 'book', array( 'public' => true, 'has_archive' => true ) );
return get_post_type_archive_feed_link( 'book' );
