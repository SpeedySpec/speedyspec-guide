<?php
// Ajax handler for the Enable or Disable auto-updates links: adds or removes a plugin or theme in its auto_update option.
$sent = json_decode( guide_ajax( 'wp_ajax_toggle_auto_updates', array( 'type' => 'plugin', 'asset' => 'hello.php', 'state' => 'enable' ), 'updates' ), true );
return array( $sent['success'], get_site_option( 'auto_update_plugins' ) );
