<?php
// NOOP translations do nothing: originals come back as they are, with English plural rules, and nothing can be added.
$noop = new NOOP_Translations();
$other = new Translations();
$noop->merge_with( $other );
$noop->set_header( 'Language', 'fr' );
$noop->set_headers( array( 'X' => 'y' ) );
$entry = new Translation_Entry( array( 'singular' => 'x' ) );
return array( $noop->add_entry( $entry ), $noop->get_header( 'Language' ), $noop->translate( 'Hello' ), $noop->translate_plural( 'one', 'many', 2 ), $noop->select_plural_form( 1 ), $noop->get_plural_forms_count(), $noop->translate_entry( $entry ) );
