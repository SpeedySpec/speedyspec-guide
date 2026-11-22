<?php
// Sets a field of a network user, such as spam, firing make_spam_user or make_ham_user; deprecated in 5.3.0 for wp_update_user().
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v" . ( $r ? " for $r" : '' ) . "\n" ), 10, 3 );
$grace = wpmu_create_user( 'grace', 'secret', 'grace@example.org' );
add_action( 'make_spam_user', fn( $id ) => print( "make_spam_user\n" ) );
update_user_status( $grace, 'spam', 1 );
return get_userdata( $grace )->spam;
