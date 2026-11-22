<?php
// Ajax handler for the file editors' Update File button: saves the file through wp_edit_theme_plugin_file() and sends the result as JSON.
$sent = json_decode( guide_ajax( 'wp_ajax_edit_theme_plugin_file', array( 'file' => 'style.css', 'theme' => get_stylesheet(), 'newcontent' => '/* x */' ) ), true );
return array( $sent['success'], $sent['data']['code'] );
