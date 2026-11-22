<?php
// A jar holds cookies by name, making Cookie objects of plain values.
$jar = new WpOrg\Requests\Cookie\Jar( array( 'a' => '1' ) );
$jar['b'] = new WpOrg\Requests\Cookie( 'b', '2' );
unset( $jar['a'] );
return array( get_class( $jar['b'] ), (string) $jar['b'], isset( $jar['a'] ), $jar['missing'], count( iterator_to_array( $jar ) ), get_class( $jar->normalize_cookie( 'v', 'k' ) ) );
