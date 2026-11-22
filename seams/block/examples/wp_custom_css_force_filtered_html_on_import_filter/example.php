<?php
// Hooked to force_filtered_html_on_import: strips block custom CSS during filtered imports, whatever the user's capabilities.
wp_custom_css_force_filtered_html_on_import_filter( true );
return has_filter( 'content_save_pre', 'wp_strip_custom_css_from_blocks' );
