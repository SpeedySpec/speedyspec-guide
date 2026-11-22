<?php
// Whether the request is for a page that must keep working after a fatal error: the login page, the admin, protected AJAX actions, and what is_protected_endpoint adds.
$plain = is_protected_endpoint();
$GLOBALS['pagenow'] = 'wp-login.php';
return array( $plain, is_protected_endpoint() );
