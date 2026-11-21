<?php
// make_headers() parses a header block; set_header() for Plural-Forms also sets nplurals and the plural function; parenthesize_plural_exression() wraps ternaries.
$t = new Gettext_Translations();
$headers = $t->make_headers( "Language: fr\nPlural-Forms: nplurals=2; plural=n>1;\n" );
$t->set_header( 'Plural-Forms', 'nplurals=3; plural=n%10==1 ? 0 : n==2 ? 1 : 2;' );
return array( $headers, $t->_nplurals, call_user_func( $t->_gettext_select_plural_form, 2 ), $t->parenthesize_plural_exression( 'n==1 ? 0 : n==2 ? 1 : 2' ), call_user_func( $t->make_plural_form_function( 2, 'n != 1' ), 1 ) );
