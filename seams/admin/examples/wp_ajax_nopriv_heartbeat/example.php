<?php
// Ajax handler for the Heartbeat API for logged-out visitors: passes the data through heartbeat_nopriv_received and heartbeat_nopriv_send.
$sent = json_decode( guide_ajax( 'wp_ajax_nopriv_heartbeat', array( 'screen_id' => 'front', 'data' => array() ) ), true );
return isset( $sent['server_time'] );
