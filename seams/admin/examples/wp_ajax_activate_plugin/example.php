<?php
// Ajax handler for the plugin installer's Activate button: activates a plugin and sends the result as JSON.
$sent = json_decode( guide_ajax( 'wp_ajax_activate_plugin', array( 'plugin' => 'hello.php', 'slug' => 'hello-dolly', 'name' => 'Hello Dolly' ), 'updates' ), true );
return array( $sent['success'], is_plugin_active( 'hello.php' ) );
