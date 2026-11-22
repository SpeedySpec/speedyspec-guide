<?php
// A tag by ID or object, or null.
$tag = wp_insert_term( 'alpha', 'post_tag' )['term_id'];
return array( get_tag( $tag )->name, get_tag( 999 ) );
