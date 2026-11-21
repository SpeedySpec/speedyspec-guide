<?php
// set_header() turns the Plural-Forms header into a plural function, which gettext_select_plural_form() uses: here French, singular for 0 and 1. Gettext_Translations itself still translates plurals with English rules; MO and PO select with the header.
$fr = new Gettext_Translations();
$fr->set_header( 'Plural-Forms', 'nplurals=2; plural=n>1;' );
$fr->add_entry( new Translation_Entry( array( 'singular' => 'Post', 'translations' => array( 'Article' ) ) ) );
$fr->add_entry( new Translation_Entry( array( 'singular' => 'Post', 'context' => 'verb', 'translations' => array( 'Publier' ) ) ) );
$fr->add_entry( new Translation_Entry( array( 'singular' => '%d comment', 'plural' => '%d comments', 'translations' => array( '%d commentaire', '%d commentaires' ) ) ) );
return array( $fr->gettext_select_plural_form( 0 ), $fr->gettext_select_plural_form( 2 ), $fr->translate_plural( '%d comment', '%d comments', 0 ), $fr->get_plural_forms_count(), $fr->nplurals_and_expression_from_header( 'nplurals=3; plural=(n==1 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2);' ) );
