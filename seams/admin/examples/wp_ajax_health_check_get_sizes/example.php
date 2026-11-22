<?php
// Ajax handler for Site Health's folder sizes. Deprecated in 5.6.0; the REST API answers it.
$sent = json_decode( guide_ajax( 'wp_ajax_health_check_get_sizes', array(), 'health-check-site-status-result' ), true );
return isset( $sent['success'] );
