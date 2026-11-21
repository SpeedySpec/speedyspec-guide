<?php
// Exports headers and entries as PO text, with a comment before the headers; an entry without a singular gives false.
$po = new PO();
$po->set_header( 'Language', 'fr' );
$po->set_comment_before_headers( 'Translations for Guide' );
$po->add_entry( new Translation_Entry( array( 'singular' => 'Post', 'context' => 'noun', 'translations' => array( 'Article' ), 'references' => array( 'a.php:1' ), 'extracted_comments' => 'A post', 'flags' => array( 'fuzzy' ) ) ) );
$po->add_entry( new Translation_Entry( array( 'singular' => '%d item', 'plural' => '%d items', 'translations' => array( '%d élément', '%d éléments' ) ) ) );
return array( $po->export(), PO::export_entry( new Translation_Entry() ) );
