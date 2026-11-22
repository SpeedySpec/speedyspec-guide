<?php
// Hooked to delete_option_site_logo: removes the custom_logo theme mod.
set_theme_mod( 'custom_logo', 42 );
$before = isset( get_theme_mods()['custom_logo'] );
_delete_custom_logo_on_remove_site_logo();
return array( $before, isset( get_theme_mods()['custom_logo'] ) );
