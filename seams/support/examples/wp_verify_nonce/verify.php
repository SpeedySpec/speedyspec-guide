<?php
// Whether a nonce is right for an action and the current user and session: 1 when made in this tick, 2 in the one before, false otherwise (wp_verify_nonce_failed fires).
$nonce = wp_create_nonce( 'delete-post_7' );
return array( wp_verify_nonce( $nonce, 'delete-post_7' ), wp_verify_nonce( $nonce, 'delete-post_8' ), wp_verify_nonce( '', 'x' ) );
