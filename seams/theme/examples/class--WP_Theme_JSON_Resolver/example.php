<?php
// WP_Theme_JSON_Resolver gathers theme.json from its origins: WordPress's defaults, blocks' block.json, the theme (and its parent), and the user's global styles post; translated, cached, and merged into what the site uses.
switch_theme( 'twentytwentyfive' );
WP_Theme_JSON_Resolver::clean_cached_data();
$merged = WP_Theme_JSON_Resolver::get_merged_data();
$palette = $merged->get_settings()['color']['palette'];
return array( WP_Theme_JSON_Resolver::theme_has_support(), array_keys( $palette ), count( WP_Theme_JSON_Resolver::get_style_variations() ) > 0, get_class( WP_Theme_JSON_Resolver::get_core_data() ) );
