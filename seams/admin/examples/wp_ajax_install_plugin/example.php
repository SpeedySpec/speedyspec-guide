<?php
// Ajax handler for the Install Now button: installs a plugin from WordPress.org and sends the result, with the activation link, as JSON.
$sent = json_decode( guide_ajax( 'wp_ajax_install_plugin', array( 'slug' => '' ), 'updates' ), true );
return array( $sent['success'], $sent['data']['errorCode'] );
