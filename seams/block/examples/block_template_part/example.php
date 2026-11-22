<?php
// Prints a template part of the active theme by slug, rendered.
switch_theme( 'twentytwentyfive' );
wp_set_template_globals();
$GLOBALS['_wp_theme_features']['block-templates'] = true;
// The theme's parts hold its patterns, which register on init for the active theme.
_register_theme_block_patterns();
return str_contains( guide_render( fn() => block_template_part( 'header' ) ), 'wp-block' );
