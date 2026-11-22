<?php
// The starter content for a fresh site in the Customizer: widgets, pages with patterns, options, menus; twenty_twenty_one_starter_content filters it.
guide_theme( 'twentytwentyone' );
require_once get_template_directory() . '/inc/starter-content.php';
$content = twenty_twenty_one_get_starter_content();
return array( array_keys( $content ), array_keys( $content['posts'] ), array_keys( $content['nav_menus'] ) );
