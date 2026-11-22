<?php
// Prints the notice that the theme needs WordPress 4.7 or newer, with the running version.
guide_theme( 'twentynineteen' );
require_once get_template_directory() . '/inc/back-compat.php';
$GLOBALS['wp_version'] = '4.6';
return guide_render( 'twentynineteen_upgrade_notice' );
