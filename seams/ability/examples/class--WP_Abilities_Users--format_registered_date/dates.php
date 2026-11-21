<?php
// The stored GMT date as ISO 8601 in a timezone, or null when it isn't a usable date.
guide_core_abilities();
$users = new WP_Abilities_Users();
function guide_user( $registered ) { $user = ( new ReflectionClass( 'WP_User' ) )->newInstanceWithoutConstructor(); $user->data = (object) array( 'user_registered' => $registered ); return $user; }
$user = guide_user( '2026-01-02 03:04:05' );
$zero = guide_user( '0000-00-00 00:00:00' );
return array( guide_private( $users, 'format_registered_date', $user, new DateTimeZone( 'Asia/Tokyo' ) ), guide_private( $users, 'format_registered_date', $zero, new DateTimeZone( 'UTC' ) ) );
