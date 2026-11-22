<?php
// Every HTML file under a theme's template folder, recursively.
switch_theme( 'twentytwentyfive' );
wp_set_template_globals();
return array_map( fn( $p ) => str_replace( get_theme_root(), '<themes>', $p ), _get_block_templates_paths( get_stylesheet_directory() ) );
