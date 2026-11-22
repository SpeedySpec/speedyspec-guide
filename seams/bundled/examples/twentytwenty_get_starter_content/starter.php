<?php
// The starter content for a fresh site in the Customizer: widgets, the front page with its cover, pages, options and menus; twentytwenty_starter_content filters it.
guide_theme( 'twentytwenty' );
require_once get_template_directory() . '/inc/starter-content.php';
$content = twentytwenty_get_starter_content();
return array( array_keys( $content ), array_keys( $content['nav_menus'] ) );
