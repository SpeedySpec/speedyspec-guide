<?php
// The input checks the library uses for arguments.
use WpOrg\Requests\Utility\InputValidator as V;
$iri = new WpOrg\Requests\Iri( 'http://x' );
return array( V::is_string_or_stringable( $iri ), V::is_numeric_array_key( '5' ), V::is_numeric_array_key( 1.5 ), V::is_stringable_object( 'x' ), V::has_array_access( new ArrayObject() ), V::is_iterable( new ArrayIterator() ), V::is_curl_handle( 'x' ) );
