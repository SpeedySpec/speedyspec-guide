<?php
// Adds the Interactivity API directives and markup the Image block's lightbox needs.
add_filter( 'wp_get_global_settings', '__return_empty_array' );
$block = parse_blocks( '<!-- wp:image {"lightbox":{"enabled":true}} --><figure class="wp-block-image"><img src="http://example.org/a.jpg" alt=""/></figure><!-- /wp:image -->' )[0];
$html = block_core_image_render_lightbox( render_block( $block ), $block, new WP_Block( $block ) );
return str_contains( $html, 'data-wp-interactive="core/image"' );
