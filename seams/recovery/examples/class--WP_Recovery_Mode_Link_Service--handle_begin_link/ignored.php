<?php
// Acts only on wp-login.php with action=enter_recovery_mode and a token and key; anything else is left alone. (A valid link sets the cookie and redirects; an invalid one stops with wp_die().)
$service = new WP_Recovery_Mode_Link_Service( new WP_Recovery_Mode_Cookie_Service(), new WP_Recovery_Mode_Key_Service() );
$GLOBALS['pagenow'] = 'index.php';
$_GET = array( 'action' => 'enter_recovery_mode', 'rm_token' => 't', 'rm_key' => 'k' );
$service->handle_begin_link( DAY_IN_SECONDS );
$GLOBALS['pagenow'] = 'wp-login.php';
$_GET = array( 'action' => 'login' );
return $service->handle_begin_link( DAY_IN_SECONDS );
