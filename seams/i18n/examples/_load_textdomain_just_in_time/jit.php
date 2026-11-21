<?php
// Loads a text domain's translations the first time a string of it is translated, from the registry's paths; get_translations_for_domain() uses it, giving NOOP translations when there are none.
switch_to_locale( 'fr_FR' );
$loaded = is_textdomain_loaded( 'guide' );
$hello = __( 'Hello', 'guide' );
return array( $loaded, $hello, is_textdomain_loaded( 'guide' ), get_class( get_translations_for_domain( 'guide' ) ), get_class( get_translations_for_domain( 'nothing' ) ), _load_textdomain_just_in_time( 'nothing' ) );
