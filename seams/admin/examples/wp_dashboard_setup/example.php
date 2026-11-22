<?php
// Registers the dashboard's widgets (At a Glance, Activity, Quick Draft, Events and News, Site Health and the others), fires wp_dashboard_setup and saves widget control forms.
set_current_screen( 'dashboard' );
wp_dashboard_setup();
return array_keys( $GLOBALS['wp_meta_boxes']['dashboard']['normal']['core'] );
