<?php
// Hooked to xmlrpc_pingback_error: turns a failed pingback's error into code 0, except the pingback codes.
require_once ABSPATH . WPINC . '/class-IXR.php';
return array( xmlrpc_pingback_error( new IXR_Error( 48, 'already registered' ) )->code, xmlrpc_pingback_error( new IXR_Error( 99, 'odd' ) )->code );
