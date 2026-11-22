<?php
// Ajax handler for the plugin installer's search: asks the Plugins API and sends the matching plugin cards as JSON.
guide_queue_http( array( array( 'info' => array( 'page' => 1, 'pages' => 1, 'results' => 0 ), 'plugins' => array() ) ) );
$sent = json_decode( guide_ajax( 'wp_ajax_search_install_plugins', array( 's' => 'tea', 'tab' => 'search', 'pagenow' => 'plugin-install' ), 'updates' ), true );
return $sent['success'];
