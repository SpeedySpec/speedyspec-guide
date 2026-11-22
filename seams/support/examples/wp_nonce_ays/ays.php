<?php
// Ends a request whose nonce failed with an are-you-sure page; for log-out, a link to log out anyway.
$_SERVER['REQUEST_URI'] = '/wp-admin/post.php';
$save = guide_dies( fn() => wp_nonce_ays( 'save-post' ) );
$logout = guide_dies( fn() => wp_nonce_ays( 'log-out' ) );
return array( $save, preg_replace( '/_wpnonce=\w+/', '_wpnonce=NONCE', $logout['message'] ) );
