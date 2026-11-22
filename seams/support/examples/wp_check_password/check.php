<?php
// Whether a password matches a hash: WordPress's bcrypt, phpass and old MD5 hashes are accepted; check_password filters the answer.
return array( wp_check_password( 'secret', wp_hash_password( 'secret' ) ), wp_check_password( 'secret', md5( 'secret' ) ), wp_check_password( 'nope', md5( 'secret' ) ) );
