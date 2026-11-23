<?php
// Turns a theme's editable files into a nested folder tree for the file editor.
return wp_make_theme_file_tree( array( 'style.css' => '/x/style.css', 'templates/index.html' => '/x/templates/index.html' ) );
