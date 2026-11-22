<?php
// Switches the translations to another locale, firing switch_locale and change_locale; restore_previous_locale() goes back one, restore_current_locale() all the way; is_locale_switched() tells.
add_action( 'switch_locale', fn( $l ) => print( "switch_locale $l\n" ) );
add_action( 'restore_previous_locale', fn( $l, $prev ) => print( "restore_previous_locale $l $prev\n" ), 10, 2 );
add_action( 'change_locale', fn( $l ) => print( "change_locale $l\n" ) );
$results = array( switch_to_locale( 'fr_FR' ), __( 'Hello' ), is_locale_switched(), switch_to_locale( 'de_DE' ), switch_to_locale( 'fr_FR' ) );
$results[] = restore_previous_locale();
$results[] = restore_current_locale();
$results[] = is_locale_switched();
$results[] = restore_previous_locale();
return $results;
