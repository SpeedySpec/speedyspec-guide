<?php
// Switches the translations to another locale, firing switch_locale and change_locale; restore_previous_locale() goes back one, restore_current_locale() all the way; is_locale_switched() tells.
function guide_print_switch_locale( $locale ) {
	echo "switch_locale $locale\n";
}
add_action( 'switch_locale', 'guide_print_switch_locale' );
function guide_print_restore_previous_locale( $locale, $previous ) {
	echo "restore_previous_locale $locale $previous\n";
}
add_action( 'restore_previous_locale', 'guide_print_restore_previous_locale', 10, 2 );
function guide_print_change_locale( $locale ) {
	echo "change_locale $locale\n";
}
add_action( 'change_locale', 'guide_print_change_locale' );
$results = array( switch_to_locale( 'fr_FR' ), __( 'Hello' ), is_locale_switched(), switch_to_locale( 'de_DE' ), switch_to_locale( 'fr_FR' ) );
$results[] = restore_previous_locale();
$results[] = restore_current_locale();
$results[] = is_locale_switched();
$results[] = restore_previous_locale();
return $results;
