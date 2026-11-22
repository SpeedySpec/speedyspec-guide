<?php
// Prints the footer template part.
switch_theme( 'twentytwentyfive' );
wp_set_template_globals();
$GLOBALS['_wp_theme_features']['block-templates'] = true;
// The theme's parts hold its patterns, which register on init for the active theme.
_register_theme_block_patterns();
return strlen( guide_render( 'block_footer_area' ) ) > 0;
