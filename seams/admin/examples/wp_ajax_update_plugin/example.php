<?php
// Ajax handler for the Update Now link: updates a plugin and sends the result, with the new version, as JSON.
$sent = json_decode( guide_ajax( 'wp_ajax_update_plugin', array( 'plugin' => '', 'slug' => '' ), 'updates' ), true );
return array( $sent['success'], $sent['data']['errorCode'] );
