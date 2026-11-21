<?php
// The base translations: entries by key, the translation for a context, or the original when there's none; plurals use English rules (one, or other).
$fr = new Translations();
$fr->set_header( 'Plural-Forms', 'nplurals=2; plural=n>1;' );
$fr->add_entry( new Translation_Entry( array( 'singular' => 'Post', 'translations' => array( 'Article' ) ) ) );
$fr->add_entry( new Translation_Entry( array( 'singular' => 'Post', 'context' => 'verb', 'translations' => array( 'Publier' ) ) ) );
$fr->add_entry( new Translation_Entry( array( 'singular' => '%d comment', 'plural' => '%d comments', 'translations' => array( '%d commentaire', '%d commentaires' ) ) ) );
return array( $fr->translate( 'Post' ), $fr->translate( 'Post', 'verb' ), $fr->translate( 'Page' ), $fr->translate_plural( '%d comment', '%d comments', 1 ), $fr->translate_plural( '%d comment', '%d comments', 0 ), $fr->select_plural_form( 5 ), $fr->get_plural_forms_count() );
