<?php
// Ajax handler for the Heartbeat API: passes the data scripts sent through heartbeat_received and heartbeat_send, and sends the answer with the server time as JSON.
$sent = json_decode( guide_ajax( 'wp_ajax_heartbeat', array( '_nonce' => wp_create_nonce( 'heartbeat-nonce' ), 'screen_id' => 'dashboard', 'data' => array() ) ), true );
return array( isset( $sent['server_time'] ), $sent['wp-auth-check'] ?? null );
