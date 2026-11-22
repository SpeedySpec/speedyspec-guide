<?php
// Ajax handler that loads a slow dashboard widget, such as WordPress Events and News, after the page.
guide_queue_http( array() );
$sent = guide_ajax( 'wp_ajax_dashboard_widgets', array( 'widget' => 'dashboard_primary', 'pagenow' => 'dashboard' ) );
return str_contains( $sent, 'rss-widget' );
