<?php
// Sets the stylesheet and template folder globals that template loading searches, from the active theme.
switch_theme( 'twentytwentyone' );
wp_set_template_globals();
return array( str_replace( get_theme_root(), '<themes>', $GLOBALS['wp_stylesheet_path'] ), str_replace( get_theme_root(), '<themes>', $GLOBALS['wp_template_path'] ) );
