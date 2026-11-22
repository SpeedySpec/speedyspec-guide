<?php
// Prints every Underscore template the media modal uses (attachment details, uploader, galleries, image editing); fires print_media_templates.
require_once ABSPATH . WPINC . '/media-template.php';
$html = guide_render( 'wp_print_media_templates' );
return array( substr_count( $html, 'type="text/html"' ) > 20, did_action( 'print_media_templates' ) );
