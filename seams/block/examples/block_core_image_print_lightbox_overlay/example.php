<?php
// Hooked to wp_footer: prints the lightbox overlay markup once, for Image blocks with the lightbox on.
$html = guide_render( 'block_core_image_print_lightbox_overlay' );
return str_contains( $html, 'wp-lightbox-overlay' );
