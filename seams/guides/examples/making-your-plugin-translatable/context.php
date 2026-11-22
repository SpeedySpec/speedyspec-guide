<?php
// The same English word can need different translations; _x() tells translators which meaning you want.
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
		array( 'context' => 'verb', 'singular' => 'Post', 'translations' => array( 'Publier' ) ),
		array( 'context' => 'noun', 'singular' => 'Post', 'translations' => array( 'Article' ) ),
	)
);

return array(
	'button'  => _x( 'Post', 'verb', 'my-plugin' ),
	'heading' => _x( 'Post', 'noun', 'my-plugin' ),
);
