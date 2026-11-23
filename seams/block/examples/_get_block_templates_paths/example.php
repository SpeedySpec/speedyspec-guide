<?php
// Every HTML file under a theme's template folder, recursively, in the order the file system lists them.
switch_theme( 'twentytwentyfive' );
wp_set_template_globals();
$paths = array_map( fn( $p ) => str_replace( get_theme_root(), '<themes>', $p ), _get_block_templates_paths( get_stylesheet_directory() ) );
sort( $paths );
return array_slice( $paths, 0, 6 );
