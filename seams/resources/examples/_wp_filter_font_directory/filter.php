<?php
// Turns the uploads folder into the fonts folder (basedir/fonts, no subdir), then filters it with font_dir; attached to upload_dir while font folders are worked out.
return _wp_filter_font_directory( array( 'basedir' => '/up', 'baseurl' => 'http://x/up', 'path' => '/up/2026/03', 'url' => 'u', 'subdir' => '/2026/03', 'error' => false ) );
