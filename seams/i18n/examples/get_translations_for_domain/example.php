<?php
switch_to_locale( 'fr_FR' );
// A text domain's translations, loaded just in time; a domain with none gets a shared NOOP_Translations.
$noop = get_translations_for_domain( 'none' );
return array( get_class( get_translations_for_domain( 'guide' ) ), get_class( $noop ), $noop === get_translations_for_domain( 'other' ) );
