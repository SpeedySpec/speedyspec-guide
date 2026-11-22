<?php
// Deprecated in 3.2.0; use wp_dashboard_quick_press(). Printed the QuickPress widget, now through wp_dashboard_quick_press().
require_once ABSPATH . 'wp-admin/includes/dashboard.php';
list( $result, $notice ) = guide_deprecated( 'wp_dashboard_quick_press_output' );
return array( strtok( $notice, '<' ), str_contains( $notice, 'quick-press' ) );
