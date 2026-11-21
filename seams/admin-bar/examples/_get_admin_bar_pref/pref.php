<?php
// The user's show_admin_bar_front option: true unless it is 'false'.
guide_log_in( array( 'read' => true ) );
$default = _get_admin_bar_pref();
wp_cache_replace( 1, array( 'wp_capabilities' => array( serialize( array( 'guide' => true ) ) ), 'show_admin_bar_front' => array( 'false' ) ), 'user_meta' );
return array( $default, _get_admin_bar_pref( 'front', 1 ) );
