<?php
// Queues the theme.json CSS custom properties (presets) as global-styles-css-custom-properties, for the classic editor.
guide_theme( 'twentytwentyfive' );
wp_enqueue_global_styles_css_custom_properties();
return array( wp_style_is( 'global-styles-css-custom-properties' ), str_contains( implode( '', (array) wp_styles()->get_data( 'global-styles-css-custom-properties', 'after' ) ), '--wp--preset--' ) );
