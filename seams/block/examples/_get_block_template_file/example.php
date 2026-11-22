<?php
// A theme's template or part file by type and slug: its slug, path, theme and type, the child theme first; null when missing.
switch_theme( 'twentytwentyfive' );
wp_set_template_globals();
$file = _get_block_template_file( 'wp_template', 'single' );
return array( $file['slug'], $file['theme'], basename( $file['path'] ) );
