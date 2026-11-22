<?php
// Asks the WordPress.org Themes API for a theme's information, a search or the feature list; themes_api_args, themes_api and themes_api_result filter it.
guide_queue_http( array( array( 'name' => 'Twenty Twenty-Five', 'slug' => 'twentytwentyfive', 'version' => '1.3' ) ) );
$info = themes_api( 'theme_information', array( 'slug' => 'twentytwentyfive' ) );
return array( $info->name, $info->version );
