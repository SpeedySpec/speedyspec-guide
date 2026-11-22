<?php
// Response headers are case-insensitive and keep every value: reading gives them joined by commas, getValues() as a list.
$h = new WpOrg\Requests\Response\Headers();
$h['Set-Cookie'] = 'a=1';
$h['set-cookie'] = 'b=2';
$h['X'] = 'y';
return array( $h['SET-COOKIE'], $h->getValues( 'Set-Cookie' ), $h->getValues( 'nope' ), iterator_to_array( $h ), isset( $h['x'] ), $h->flatten( array( 'a', 'b' ) ) );
