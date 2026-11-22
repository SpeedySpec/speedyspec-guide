<?php
// Adds the apiFetch middleware that keeps REST requests on the previewed theme, for users who can switch themes.
$_GET['wp_theme_preview'] = 'twentytwentyfive';
wp_attach_theme_preview_middleware();
return str_contains( implode( '', (array) wp_scripts()->get_data( 'wp-api-fetch', 'after' ) ), 'createThemePreviewMiddleware' );
