<?php
// A user's sessions, stored hashed in the session_tokens user meta: create() makes a token with its expiry, IP, user agent and login time (attach_session_information filters them); verify(), get(), update(), destroy() and destroy_others() work with them.
$sessions = WP_Session_Tokens::get_instance( 1 );
$token = $sessions->create( time() + 3600 );
$other = $sessions->create( time() + 3600 );
$session = $sessions->get( $token );
$valid = $sessions->verify( $token );
$sessions->destroy_others( $token );
return array( strlen( $token ), array_keys( $session ), $valid, $sessions->verify( 'wrong' ), $sessions->verify( $other ), count( $sessions->get_all() ), get_class( $sessions ) );
