<?php
// Checks an AJAX request's nonce (_ajax_nonce or _wpnonce, or the field named): 1 or 2 when valid; false when told not to stop, otherwise a -1 response that ends the request (403 for AJAX requests).
$_REQUEST['_ajax_nonce'] = wp_create_nonce( 'fetch' );
$ok = check_ajax_referer( 'fetch' );
$_REQUEST['_ajax_nonce'] = 'bad';
return array( $ok, check_ajax_referer( 'fetch', false, false ) );
