<?php
// Whether meta has every condition's key with the same value, comparing nested arrays key by key.
$meta = array( 'public' => true, 'annotations' => array( 'readonly' => true, 'destructive' => false ) );
return array(
	_wp_get_abilities_match_meta( $meta, array( 'annotations' => array( 'readonly' => true ) ) ),
	_wp_get_abilities_match_meta( $meta, array( 'public' => 1 ) ),
	_wp_get_abilities_match_meta( $meta, array( 'missing' => null ) ),
);
