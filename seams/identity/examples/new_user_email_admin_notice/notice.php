<?php
// On the profile screen after an email change, prints the notice that a confirmation was sent.
$GLOBALS['pagenow'] = 'profile.php';
$_GET['updated'] = 1;
update_user_meta( 1, '_new_email', array( 'hash' => 'x', 'newemail' => 'new@example.org' ) );
return preg_replace( '/_wpnonce=\w+/', '_wpnonce=NONCE', guide_render( 'new_user_email_admin_notice' ) );
