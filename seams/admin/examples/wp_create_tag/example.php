<?php
// The ID of a tag by name, creating it when missing.
$tag = wp_create_tag( 'oolong' );
return get_term( $tag['term_id'] )->name;
