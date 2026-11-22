<?php
// Whether a stored hash should be replaced by a fresh one: it isn't WordPress's current algorithm and options.
return array( wp_password_needs_rehash( wp_hash_password( 'x' ) ), wp_password_needs_rehash( md5( 'x' ) ) );
