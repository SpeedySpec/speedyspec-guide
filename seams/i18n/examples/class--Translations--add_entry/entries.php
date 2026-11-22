<?php
// add_entry() replaces an entry with the same key and refuses one without a singular; add_entry_or_merge() merges instead; set_headers(), get_header() and translate_entry().
$t = new Translations();
$t->add_entry( array( 'singular' => 'a', 'translations' => array( 'A1' ) ) );
$t->add_entry( array( 'singular' => 'a', 'translations' => array( 'A2' ) ) );
$refused = $t->add_entry( array( 'translations' => array( 'x' ) ) );
$t->add_entry_or_merge( new Translation_Entry( array( 'singular' => 'a', 'flags' => array( 'f' ) ) ) );
$t->set_headers( array( 'Language' => 'fr' ) );
$entry = new Translation_Entry( array( 'singular' => 'a' ) );
return array( count( $t->entries ), $t->entries['a']->translations, $t->entries['a']->flags, $refused, $t->get_header( 'Language' ), $t->get_header( 'Nope' ), $t->translate_entry( $entry )->translations );
