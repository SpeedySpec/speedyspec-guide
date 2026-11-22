<?php
// Put values in with sprintf() placeholders, numbered so translators can reorder them, and say what each one is.
// A stand-in for my-plugin-fr_FR.mo: a French translation, loaded the way WordPress loads one.
function guide_load_french( array $entries ) {
	$mo = new MO();
	$mo->set_header( 'Plural-Forms', 'nplurals=2; plural=(n > 1);' );
	foreach ( $entries as $entry ) {
		$mo->add_entry( new Translation_Entry( $entry ) );
	}
	$GLOBALS['l10n']['my-plugin'] = $mo;
}
guide_load_french( array( array( 'singular' => '%1$s by %2$s', 'translations' => array( '%2$s a écrit %1$s' ) ) ) );

function my_plugin_book_byline( $title, $author ) {
	/* translators: 1: A book's title. 2: Its author's name. */
	return sprintf( __( '%1$s by %2$s', 'my-plugin' ), $title, $author );
}

function my_plugin_book_byline_wrongly( $title, $author ) { // Don't do this: no translation can match the string.
	return __( "$title by $author", 'my-plugin' );
}
return array(
	'placeholders'      => my_plugin_book_byline( 'Dune', 'Frank Herbert' ),
	'variables inside'  => my_plugin_book_byline_wrongly( 'Dune', 'Frank Herbert' ),
);
