<?php
// On WordPress older than 4.7 (where back-compat.php is loaded), switches back to the default theme and adds the upgrade notice; on after_switch_theme.
guide_theme( 'twentynineteen' );
require_once get_template_directory() . '/inc/back-compat.php';
$GLOBALS['wp_version'] = '4.6';
twentynineteen_switch_theme();
return array( get_option( 'stylesheet' ), has_action( 'admin_notices', 'twentynineteen_upgrade_notice' ) );
