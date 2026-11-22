<?php
// Prints the notice that the user's browser is out of date or insecure, from the Browse Happy check.
$_SERVER['HTTP_USER_AGENT'] = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)';
guide_queue_http( array( array( 'platform' => 'Windows', 'name' => 'Internet Explorer', 'version' => '6.0', 'current_version' => '11', 'upgrade' => true, 'insecure' => true, 'update_url' => 'https://browsehappy.com/', 'img_src' => '', 'img_src_ssl' => '' ) ) );
return str_contains( guide_render( 'wp_dashboard_browser_nag' ), 'Internet Explorer' );
