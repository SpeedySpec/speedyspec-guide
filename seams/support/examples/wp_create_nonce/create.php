<?php
// A nonce for an action, tied to the current user, their session token and the tick: ten characters.
$a = wp_create_nonce( 'save' );
return array( strlen( $a ), $a === wp_create_nonce( 'save' ), $a === wp_create_nonce( 'other' ) );
