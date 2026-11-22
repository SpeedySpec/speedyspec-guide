<?php
// A term's feed URL, by taxonomy and feed type; filtered by category_feed_link, tag_feed_link or taxonomy_feed_link.
$tag = wp_insert_term( 'Red', 'post_tag' )['term_id'];
return array( get_term_feed_link( $tag, 'post_tag' ), get_term_feed_link( 999 ) );
