<?php
// The template parts the theme's theme.json declares, with their titles and areas; cached.
guide_theme( 'twentytwentyfive' );
return wp_list_pluck( wp_get_theme_data_template_parts(), 'area', 'name' );
