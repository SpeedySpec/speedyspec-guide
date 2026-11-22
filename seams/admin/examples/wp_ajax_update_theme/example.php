<?php
// Ajax handler for a theme's Update Now link: updates the theme and sends the result, with the new version, as JSON.
$sent = json_decode( guide_ajax( 'wp_ajax_update_theme', array( 'slug' => '' ), 'updates' ), true );
return array( $sent['success'], $sent['data']['errorCode'] );
