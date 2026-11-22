<?php
// Prints the notice that the theme needs WordPress 5.3 or newer, with the running version.
guide_theme( 'twentytwentyone' );
require_once get_template_directory() . '/inc/back-compat.php';
$GLOBALS['wp_version'] = '5.2';
return guide_render( 'twenty_twenty_one_upgrade_notice' );
