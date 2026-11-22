<?php
// Hooked to force_filtered_html_on_import: adds the footnotes kses filter when importing filtered HTML.
_wp_footnotes_force_filtered_html_on_import_filter( true );
return has_filter( 'sanitize_post_meta_footnotes', '_wp_filter_post_meta_footnotes' );
