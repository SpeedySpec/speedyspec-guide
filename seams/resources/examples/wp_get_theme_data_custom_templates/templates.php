<?php
// The custom templates the theme's theme.json declares, with their titles and post types.
guide_theme( 'twentytwentyfive' );
return array_keys( wp_get_theme_data_custom_templates() );
