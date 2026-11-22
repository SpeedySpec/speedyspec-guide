<?php
// _n() picks the right form for a number, by the language's own rules: French uses the singular for 0 and 1.
// A stand-in for my-plugin-fr_FR.mo: a French translation, loaded the way WordPress loads one.
function guide_load_french( array $entries ) {
	$mo = new MO();
	$mo->set_header( 'Plural-Forms', 'nplurals=2; plural=(n > 1);' );
	foreach ( $entries as $entry ) {
		$mo->add_entry( new Translation_Entry( $entry ) );
	}
	$GLOBALS['l10n']['my-plugin'] = $mo;
}
guide_load_french(
	array(
		array(
			'singular'     => '%s book',
			'plural'       => '%s books',
			'translations' => array( '%s livre', '%s livres' ),
		),
	)
);

function my_plugin_book_count( $count ) {
	/* translators: %s: The number of books. */
	return sprintf( _n( '%s book', '%s books', $count, 'my-plugin' ), number_format_i18n( $count ) );
}
return array( 0 => my_plugin_book_count( 0 ), 1 => my_plugin_book_count( 1 ), 2 => my_plugin_book_count( 2 ), 1500 => my_plugin_book_count( 1500 ) );
