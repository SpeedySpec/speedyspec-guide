<?php
// Whether a user (the current one, or by login or object) is marked as spam on the network.
$grace = wpmu_create_user( 'grace', 'secret', 'grace@example.org' );
global $wpdb;
$wpdb->update( $wpdb->users, array( 'spam' => 1 ), array( 'ID' => $grace ) );
clean_user_cache( $grace );
return array( is_user_spammy( 'grace' ), is_user_spammy() );
