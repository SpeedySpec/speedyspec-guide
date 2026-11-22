<?php
// Preloads REST responses for the editor (filtered by block_editor_rest_api_preload_paths) into apiFetch's preloading middleware.
block_editor_rest_api_preload( array( '/wp/v2/types' ), new WP_Block_Editor_Context() );
return str_contains( implode( '', (array) wp_scripts()->get_data( 'wp-api-fetch', 'after' ) ), 'createPreloadingMiddleware' );
