<?php
// Localizes the dashboard script with the user's events location (updating its IP when it changed) and the cached events, when the dashboard script is queued, as on the dashboard.
wp_register_script( 'dashboard', '/wp-admin/js/dashboard.js' );
wp_enqueue_script( 'dashboard' );
wp_localize_community_events();
return str_contains( (string) wp_scripts()->get_data( 'dashboard', 'data' ), 'var communityEventsData' );
