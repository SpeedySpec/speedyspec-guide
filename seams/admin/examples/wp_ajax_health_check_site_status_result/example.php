<?php
// Ajax handler that stores Site Health's test counts (good, recommended, critical) for the dashboard widget.
guide_ajax( 'wp_ajax_health_check_site_status_result', array( 'counts' => array( 'good' => 15, 'recommended' => 2, 'critical' => 1 ) ), 'health-check-site-status-result' );
return get_transient( 'health-check-site-status-result' );
