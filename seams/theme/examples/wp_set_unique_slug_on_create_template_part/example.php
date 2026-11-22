<?php
// Hooked to save_post_wp_template_part: gives a new template part a unique slug among the theme's.
$id = wp_insert_post( array( 'post_title' => 'Header', 'post_name' => 'header', 'post_type' => 'wp_template_part', 'post_status' => 'publish', 'tax_input' => array( 'wp_theme' => array( get_stylesheet() ) ) ) );
return has_action( 'save_post_wp_template_part', 'wp_set_unique_slug_on_create_template_part' );
