<?php
// A post's page template file, '' for the default, false when the post doesn't exist.
$page = wp_insert_post( array( 'post_title' => 'Wide', 'post_type' => 'page', 'meta_input' => array( '_wp_page_template' => 'templates/wide.php' ) ) );
return array( get_page_template_slug( $page ), get_page_template_slug( wp_insert_post( array( 'post_title' => 'X', 'post_type' => 'page' ) ) ), get_page_template_slug( 999 ) );
