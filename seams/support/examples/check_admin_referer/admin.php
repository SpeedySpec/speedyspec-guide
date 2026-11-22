<?php
// Checks a nonce from the request (_wpnonce) for an action: 1 or 2 by its age when valid; otherwise the are-you-sure page ends the request. check_admin_referer fires either way.
$_REQUEST['_wpnonce'] = wp_create_nonce( 'save' );
$ok = check_admin_referer( 'save' );
$_REQUEST['_wpnonce'] = 'bad';
return array( $ok, guide_dies( fn() => check_admin_referer( 'save' ) ) );
