<?php
// Ajax handler for Site Health's test that the site can reach WordPress.org. Deprecated in 5.6.0; the REST API runs it.
$sent = json_decode( guide_ajax( 'wp_ajax_health_check_dotorg_communication', array(), 'health-check-site-status' ), true );
return isset( $sent['success'] );
