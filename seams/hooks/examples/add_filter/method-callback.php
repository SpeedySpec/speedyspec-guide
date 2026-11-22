<?php
// Use a method as the callback; keep the object, since removing the callback needs that same object.
class Guide_Shout {
	public function shout( $text ) {
		return strtoupper( $text );
	}
}
$shout = new Guide_Shout();
add_filter( 'guide_shout', array( $shout, 'shout' ) );

return apply_filters( 'guide_shout', 'hi' );
