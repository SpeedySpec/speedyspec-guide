<?php
// A theme's template or part files, filtered by slugs, area or post type.
switch_theme( 'twentytwentyfive' );
wp_set_template_globals();
return count( _get_block_templates_files( 'wp_template' ) ) > 5;
