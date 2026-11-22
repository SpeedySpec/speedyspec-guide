<?php
// Hooked to pre_set_theme_mod_custom_logo: keeps the site_logo option in step with the custom_logo theme mod.
_sync_custom_logo_to_site_logo( 42 );
$set = get_option( 'site_logo' );
_sync_custom_logo_to_site_logo( '' );
return array( $set, get_option( 'site_logo' ) );
