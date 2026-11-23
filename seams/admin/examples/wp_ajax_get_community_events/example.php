<?php
// Ajax handler for the dashboard's WordPress Events and News: asks the Events API near the user's location and sends the events as JSON.
guide_queue_http( array( array( 'location' => array( 'description' => 'Lisbon' ), 'events' => array() ) ) );
$sent = json_decode( guide_ajax( 'wp_ajax_get_community_events', array( 'location' => 'Lisbon' ), 'community_events' ), true );
return array( $sent['success'], $sent['data']['location']['description'] ?? null );
