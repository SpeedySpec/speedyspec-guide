<?php
// Prints the Site Health Status widget from the last test results, with a link to the Site Health screen.
set_transient( 'health-check-site-status-result', wp_json_encode( array( 'good' => 15, 'recommended' => 2, 'critical' => 0 ) ) );
return str_contains( guide_render( 'wp_dashboard_site_health' ), 'site-health' );
