<?php
// add_hooks() attaches the admin's add-term AJAX handler (wp_ajax_add-{taxonomy}); remove_hooks() takes it off.
$tax = new WP_Taxonomy( 'genre', 'post', array( 'hierarchical' => true ) );
$tax->add_hooks();
$hooked = has_filter( 'wp_ajax_add-genre', '_wp_ajax_add_hierarchical_term' );
$tax->remove_hooks();
return array( $hooked, has_filter( 'wp_ajax_add-genre', '_wp_ajax_add_hierarchical_term' ) );
