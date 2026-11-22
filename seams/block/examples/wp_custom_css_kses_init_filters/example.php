<?php
// Adds the filters stripping block custom CSS from saved content, before kses.
wp_custom_css_kses_init_filters();
return has_filter( 'content_save_pre', 'wp_strip_custom_css_from_blocks' );
