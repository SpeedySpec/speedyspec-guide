<?php
// Removes the filters stripping block custom CSS.
wp_custom_css_kses_init_filters();
wp_custom_css_remove_filters();
return has_filter( 'content_save_pre', 'wp_strip_custom_css_from_blocks' );
