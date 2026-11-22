<?php
// Prints the dashboard's widget columns with their boxes.
set_current_screen( 'dashboard' );
wp_dashboard_setup();
guide_queue_http( array() );
return str_contains( guide_render( 'wp_dashboard' ), 'id="dashboard-widgets"' );
