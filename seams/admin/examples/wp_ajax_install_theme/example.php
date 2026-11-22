<?php
// Ajax handler for the theme installer's Install button: installs a theme from WordPress.org and sends the result, with the activate and preview links, as JSON.
$sent = json_decode( guide_ajax( 'wp_ajax_install_theme', array( 'slug' => '' ), 'updates' ), true );
return array( $sent['success'], $sent['data']['errorCode'] );
