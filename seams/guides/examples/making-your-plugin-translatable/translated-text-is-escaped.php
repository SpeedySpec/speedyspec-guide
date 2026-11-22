<?php
// A translation is text you didn't write: escape it like any other, with esc_html__() or esc_html( sprintf( … ) ).
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
		array( 'singular' => 'Saved.', 'translations' => array( 'Enregistré <script>alert(1)</script>' ) ),
		array( 'singular' => 'Welcome, %s!', 'translations' => array( 'Bienvenue, %s !' ) ),
	)
);

return array(
	'esc_html__()'    => esc_html__( 'Saved.', 'my-plugin' ),
	'with a value'    => esc_html(
		/* translators: %s: A person's name. */
		sprintf( __( 'Welcome, %s!', 'my-plugin' ), 'Ana <3' )
	),
);
