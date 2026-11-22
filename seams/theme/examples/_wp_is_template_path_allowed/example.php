<?php
// Whether a template locate_template() found may be loaded: a path without .. is fine; one with .. must resolve inside the theme folders or theme-compat.
switch_theme( 'twentytwentyone' );
wp_set_template_globals();
return array( _wp_is_template_path_allowed( get_theme_root() . '/twentytwentyone/page.php' ), _wp_is_template_path_allowed( get_theme_root() . '/twentytwentyone/../../../wp-config.php' ) );
