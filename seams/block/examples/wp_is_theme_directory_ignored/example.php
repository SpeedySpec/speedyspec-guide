<?php
// Whether a path is left out of theme exports: version control, node_modules, vendor and .DS_Store.
return array( wp_is_theme_directory_ignored( 'node_modules/x' ), wp_is_theme_directory_ignored( 'templates/index.html' ) );
