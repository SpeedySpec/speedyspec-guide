<?php
// Adds the upgrade notice to the admin when the theme is switched to on WordPress older than 5.3; back-compat.php is loaded only there.
guide_theme( 'twentytwentyone' );
require_once get_template_directory() . '/inc/back-compat.php';
twenty_twenty_one_switch_theme();
return has_action( 'admin_notices', 'twenty_twenty_one_upgrade_notice' );
