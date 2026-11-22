<?php
// Wrap every string people read in a translation function, with your plugin's text domain.
// A stand-in for my-plugin-fr_FR.mo: a French translation, loaded the way WordPress loads one.
function guide_load_french( array $entries ) {
	$mo = new MO();
	$mo->set_header( 'Plural-Forms', 'nplurals=2; plural=(n > 1);' );
	foreach ( $entries as $entry ) {
		$mo->add_entry( new Translation_Entry( $entry ) );
	}
	$GLOBALS['l10n']['my-plugin'] = $mo;
}
guide_load_french( array( array( 'singular' => 'Books', 'translations' => array( 'Livres' ) ) ) );

ob_start();
_e( 'Books', 'my-plugin' ); // Prints the translation.
$printed = ob_get_clean();
return array(
	'__()'             => __( 'Books', 'my-plugin' ),
	'_e()'             => $printed,
	'another domain'   => __( 'Books', 'another-plugin' ),
	'not translatable' => 'Books',
);
