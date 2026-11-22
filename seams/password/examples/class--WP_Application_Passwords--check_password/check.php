<?php
// Application passwords are hashed with wp_fast_hash(); check_password() also accepts hashes from before 6.8, through wp_check_password(). chunk_password() shows a password in groups of four.
$hash = WP_Application_Passwords::hash_password( 'abcdABCD1234efgh5678ijkl' );
return array( WP_Application_Passwords::check_password( 'abcdABCD1234efgh5678ijkl', $hash ), WP_Application_Passwords::check_password( 'nope', $hash ), WP_Application_Passwords::check_password( 'old', wp_hash_password( 'old' ) ), WP_Application_Passwords::chunk_password( 'abcdABCD1234efgh5678ijkl' ) );
