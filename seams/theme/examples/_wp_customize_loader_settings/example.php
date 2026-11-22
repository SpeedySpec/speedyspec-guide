<?php
// Hooked to admin_enqueue_scripts: passes the Customizer loader script its URL, preview support and browser checks.
_wp_customize_loader_settings();
return str_contains( (string) $GLOBALS['wp_scripts']->get_data( 'customize-loader', 'data' ), '_wpCustomizeLoaderSettings' );
