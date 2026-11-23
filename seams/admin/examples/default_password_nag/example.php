<?php
// Prints the notice to change the password WordPress generated at install, with links to change it or dismiss the notice.
update_user_meta( 1, 'default_password_nag', true );
$GLOBALS['pagenow'] = 'index.php';
return str_contains( guide_render( 'default_password_nag' ), 'auto-generated password' );
