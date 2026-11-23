<?php
// Ajax handler for the tag box's suggestions: prints the names of a taxonomy's terms that match the typed text, one per line.
wp_insert_term( 'grassy', 'post_tag' );
wp_insert_term( 'green', 'post_tag' );
wp_insert_term( 'smoky', 'post_tag' );
return guide_ajax( 'wp_ajax_ajax_tag_search', array( 'tax' => 'post_tag', 'q' => 'gr' ) );
