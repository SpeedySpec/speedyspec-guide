<?php
// Ajax handler for Site Health's loopback request test. Deprecated in 5.6.0; the REST API runs it.
$sent = json_decode( guide_ajax( 'wp_ajax_health_check_loopback_requests', array(), 'health-check-site-status' ), true );
return isset( $sent['success'] );
