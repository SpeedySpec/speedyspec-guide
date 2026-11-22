<?php
// Hooked to theme_mod_custom_logo: gives the site_logo option as the custom logo when it is set.
update_option( 'site_logo', 42 );
$with = _override_custom_logo_theme_mod( 7 );
delete_option( 'site_logo' );
return array( $with, _override_custom_logo_theme_mod( 7 ) );
