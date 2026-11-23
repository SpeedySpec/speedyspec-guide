<?php
// Ajax handler for the plugins list's Delete link: deletes a plugin's files and sends the result as JSON.
$sent = json_decode( guide_ajax( 'wp_ajax_delete_plugin', array( 'plugin' => '', 'slug' => '' ), 'updates' ), true );
return array( $sent['success'], $sent['data']['errorCode'] );
