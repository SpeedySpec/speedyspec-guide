<?php
// Keep the object you add a method of: removing the callback needs that same object, and a new one doesn't match.
class Guide_Shout {
	public function shout( $text ) {
		return strtoupper( $text );
	}
}
$shout = new Guide_Shout();
add_filter( 'guide_shout', array( $shout, 'shout' ) );
return array(
	'filtered'               => apply_filters( 'guide_shout', 'hi' ),
	'removed with a new one' => remove_filter( 'guide_shout', array( new Guide_Shout(), 'shout' ) ),
	'removed with the kept'  => remove_filter( 'guide_shout', array( $shout, 'shout' ) ),
	'after'                  => apply_filters( 'guide_shout', 'hi' ),
);
