<?php
// Tags, as get_terms() with the post_tag taxonomy; empty ones hidden by default. get_tags filters them.
wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'tags_input' => array( 'alpha', 'beta' ) ) );
wp_insert_term( 'unused', 'post_tag' );
return array( wp_list_pluck( get_tags(), 'name' ), count( get_tags( array( 'hide_empty' => false ) ) ) );
