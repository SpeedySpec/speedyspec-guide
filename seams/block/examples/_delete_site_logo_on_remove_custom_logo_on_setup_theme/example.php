<?php
// Hooked to setup_theme: hooks the site logo cleanup to the active theme's theme mods option.
_delete_site_logo_on_remove_custom_logo_on_setup_theme();
$theme = get_option( 'stylesheet' );
return array( has_action( "update_option_theme_mods_$theme", '_delete_site_logo_on_remove_custom_logo' ), has_action( "delete_option_theme_mods_$theme", '_delete_site_logo_on_remove_theme_mods' ) );
