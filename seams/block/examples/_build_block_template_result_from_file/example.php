<?php
// A WP_Block_Template from a theme's template file: content with hooked blocks and theme attributes, title, type, source theme.
switch_theme( 'twentytwentyfive' );
wp_set_template_globals();
$template = _build_block_template_result_from_file( _get_block_template_file( 'wp_template', 'page' ), 'wp_template' );
return array( $template->id, $template->source, $template->has_theme_file, $template->is_custom );
