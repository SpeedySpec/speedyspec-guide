<?php
// Prints the options of the parent page select, nested by indentation, leaving out the page being edited.
$about = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'About', 'post_status' => 'publish' ) );
wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'Team', 'post_status' => 'publish', 'post_parent' => $about ) );
return guide_render( fn() => parent_dropdown() );
