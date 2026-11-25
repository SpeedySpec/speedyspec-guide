<?php
// Whether a meta key is protected (starts with an underscore), so it isn't shown in custom fields; is_protected_meta filters it.
function guide_protect_secret_meta( $protected, $key ) {
	return $protected || 'secret' === $key;
}
add_filter( 'is_protected_meta', 'guide_protect_secret_meta', 10, 2 );
return array( is_protected_meta( '_edit_lock' ), is_protected_meta( 'color' ), is_protected_meta( 'secret' ), is_protected_meta( ' _spaced' ) );
