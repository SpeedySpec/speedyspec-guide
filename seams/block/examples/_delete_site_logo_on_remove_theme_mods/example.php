<?php
// Deletes the site_logo option when all theme mods are removed, if the theme supports a custom logo.
add_theme_support( 'custom-logo' );
update_option( 'site_logo', 42 );
_delete_site_logo_on_remove_theme_mods();
return get_option( 'site_logo' );
