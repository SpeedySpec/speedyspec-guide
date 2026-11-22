<?php
// An iterator that passes each value through a callback; unserializing it is refused, so no callback can be injected.
$it = new WpOrg\Requests\Utility\FilteredIterator( array( 'a', 'b' ), 'strtoupper' );
$copy = unserialize( serialize( $it ) );
return array( iterator_to_array( $it ), get_class( $copy ), iterator_to_array( $copy ) );
