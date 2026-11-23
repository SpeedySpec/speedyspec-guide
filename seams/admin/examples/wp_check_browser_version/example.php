<?php
// Asks the Browse Happy API about the user's browser (name, version, whether to upgrade, whether insecure), cached for a week; false without a user agent.
$_SERVER['HTTP_USER_AGENT'] = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)';
guide_queue_http( array( array( 'platform' => 'Windows', 'name' => 'Internet Explorer', 'version' => '6.0', 'current_version' => '11', 'upgrade' => true, 'insecure' => true, 'update_url' => 'https://browsehappy.com/', 'img_src' => '', 'img_src_ssl' => '' ) ) );
$check = wp_check_browser_version();
return array( $check['name'], $check['insecure'] );
