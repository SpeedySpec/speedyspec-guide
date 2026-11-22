<?php
// The fonts folder's paths and URLs, wp-content/uploads/fonts, without making it; font_dir filters it.
$dir = wp_get_font_dir();
return array( $dir['url'], $dir['subdir'] );
