<?php
// Whether the browser can upload files: every one can but iPhones, iPads and iPods before iOS 6.
$_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 (iPhone; CPU iPhone OS 5_1 like Mac OS X) Mobile';
$old = _device_can_upload();
$_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) Mobile';
return array( $old, _device_can_upload() );
