<?php
// Whether the browser is a mobile device, from its user agent (or the Sec-CH-UA-Mobile hint); wp_is_mobile filters it.
$_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) Mobile/15E148';
$phone = wp_is_mobile();
$_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)';
return array( $phone, wp_is_mobile() );
