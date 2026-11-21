<?php
// The emoji as entities, longest first, and the partials (the code points they are made of).
$entities = _wp_emoji_list( 'entities' );
$partials = _wp_emoji_list( 'partials' );
return array( in_array( '&#x1f642;', $entities, true ), in_array( '&#x200d;', $partials, true ), strlen( $entities[0] ) >= strlen( end( $entities ) ) );
