<?php
// Reads a PO file back: headers, entries with context, plurals, comments and flags; export_to_file() writes one.
$po = new PO();
$po->set_header( 'Language', 'fr' );
$po->add_entry( new Translation_Entry( array( 'singular' => 'Post', 'context' => 'noun', 'translations' => array( 'Article' ), 'translator_comments' => 'Mine', 'flags' => array( 'fuzzy' ) ) ) );
$po->add_entry( new Translation_Entry( array( 'singular' => '%d item', 'plural' => '%d items', 'translations' => array( '%d élément', '%d éléments' ) ) ) );
$file = tempnam( sys_get_temp_dir(), 'po' );
$po->export_to_file( $file );
$read = new PO();
$ok = $read->import_from_file( $file );
unlink( $file );
$entry = $read->entries[ "noun\4Post" ];
return array( $ok, $read->get_header( 'Language' ), $entry->translations, $entry->translator_comments, $entry->flags, $read->translate_plural( '%d item', '%d items', 2 ) );
