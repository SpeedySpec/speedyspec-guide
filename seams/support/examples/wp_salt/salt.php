<?php
// The secret for a scheme (auth, secure_auth, logged_in, nonce): its _KEY and _SALT constants joined, or values made and stored in options when they are missing.
return array( wp_salt( 'nonce' ), wp_salt( 'auth' ) );
