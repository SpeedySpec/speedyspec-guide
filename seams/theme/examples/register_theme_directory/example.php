<?php
// Adds a folder to search for themes, absolute or relative to wp-content.
return array( register_theme_directory( WP_CONTENT_DIR . '/themes' ), register_theme_directory( '/no/such/folder' ) );
