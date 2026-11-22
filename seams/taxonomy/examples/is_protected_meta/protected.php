<?php
// Whether a meta key is protected (starts with an underscore), so it isn't shown in custom fields; is_protected_meta filters it.
add_filter( 'is_protected_meta', fn( $protected, $key ) => $protected || 'secret' === $key, 10, 2 );
return array( is_protected_meta( '_edit_lock' ), is_protected_meta( 'color' ), is_protected_meta( 'secret' ), is_protected_meta( ' _spaced' ) );
