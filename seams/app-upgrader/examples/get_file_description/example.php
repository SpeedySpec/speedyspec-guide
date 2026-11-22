<?php
// A friendly name for a theme file in the file editor: Stylesheet, Theme Functions, a page template's name, or the file name.
$GLOBALS['allowed_files'] = array( 'style.css' => get_stylesheet_directory() . '/style.css', 'readme.txt' => get_stylesheet_directory() . '/readme.txt' );
return array( get_file_description( 'style.css' ), get_file_description( 'readme.txt' ) );
