<?php
// A tag's feed URL.
$tag = wp_insert_term( 'Red', 'post_tag' )['term_id'];
return get_tag_feed_link( $tag );
