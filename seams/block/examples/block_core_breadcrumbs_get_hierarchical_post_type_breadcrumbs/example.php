<?php
// Breadcrumb items for a hierarchical post's ancestors.
$about = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'About', 'post_status' => 'publish' ) );
$team = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'Team', 'post_status' => 'publish', 'post_parent' => $about ) );
$ada = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'Ada', 'post_status' => 'publish', 'post_parent' => $team ) );
return wp_list_pluck( block_core_breadcrumbs_get_hierarchical_post_type_breadcrumbs( $ada ), 'label' );
