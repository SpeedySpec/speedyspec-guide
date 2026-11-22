<?php
// Ajax handler for a theme's Delete link: deletes the theme's files and sends the result as JSON.
$sent = json_decode( guide_ajax( 'wp_ajax_delete_theme', array( 'slug' => '' ), 'updates' ), true );
return array( $sent['success'], $sent['data']['errorCode'] );
