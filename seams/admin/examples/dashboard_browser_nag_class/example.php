<?php
// Hooked to postbox_classes for the browser notice: marks it insecure when the browser is.
$_SERVER['HTTP_USER_AGENT'] = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)';
guide_queue_http( array( array( 'platform' => 'Windows', 'name' => 'Internet Explorer', 'version' => '6.0', 'current_version' => '11', 'upgrade' => true, 'insecure' => true, 'update_url' => 'https://browsehappy.com/', 'img_src' => '', 'img_src_ssl' => '' ) ) );
return dashboard_browser_nag_class( array() );
