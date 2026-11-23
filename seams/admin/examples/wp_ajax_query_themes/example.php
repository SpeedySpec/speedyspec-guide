<?php
// Ajax handler for the theme installer's browsing and search: asks the Themes API and sends the themes, with install and preview links, as JSON.
guide_queue_http( array( array( 'info' => array( 'page' => 1, 'pages' => 1, 'results' => 0 ), 'themes' => array() ) ) );
$sent = json_decode( guide_ajax( 'wp_ajax_query_themes', array( 'request' => array( 'browse' => 'popular' ) ) ), true );
return $sent['success'];
