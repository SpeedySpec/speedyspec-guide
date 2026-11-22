<?php
// The global styles controller serves the user's global styles post at /wp/v2/global-styles/<id>, read and updated by users who can edit theme options, and a theme's own styles and style variations under /wp/v2/global-styles/themes/<stylesheet>.
$id = WP_Theme_JSON_Resolver::get_user_global_styles_post_id();
$updated = guide_rest( 'POST', "/wp/v2/global-styles/$id", array( 'styles' => array( 'color' => array( 'background' => '#fafafa' ) ) ) );
$read = guide_rest( 'GET', "/wp/v2/global-styles/$id" )[1];
return array( $updated[0], $read['styles']['color']['background'], get_post_type( $id ), guide_rest( 'GET', '/wp/v2/global-styles/themes/not-a-theme' )[1]['code'] );
