<?php
// Sets globals from the request (POST, then GET) for each name given, empty when missing; old admin screens use it.
$_GET['action'] = 'edit';
wp_reset_vars( array( 'action', 'missing' ) );
return array( $GLOBALS['action'], $GLOBALS['missing'] );
