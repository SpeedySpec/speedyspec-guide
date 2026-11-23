<?php
// Hooked to postbox_classes for the PHP notice: marks it red when PHP is insecure or no longer acceptable.
guide_queue_http( array( array( 'recommended_version' => '8.3', 'minimum_version' => '7.4', 'is_supported' => false, 'is_secure' => false, 'is_acceptable' => false ) ) );
return dashboard_php_nag_class( array() );
