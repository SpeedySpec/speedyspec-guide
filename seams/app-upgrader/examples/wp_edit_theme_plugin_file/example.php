<?php
// Saves an edit made in the theme or plugin file editor after checking the nonce, capabilities and file, then checks the site still loads; true or an error.
return wp_edit_theme_plugin_file( array( 'file' => 'style.css', 'theme' => get_stylesheet(), 'newcontent' => '/* x */' ) )->get_error_code();
