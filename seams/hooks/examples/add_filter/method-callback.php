<?php
// Use a method as the callback.
class Guide_Shout {
	public function shout( $text ) {
		return strtoupper( $text );
	}
}
add_filter( 'guide_shout', array( new Guide_Shout(), 'shout' ) );

return apply_filters( 'guide_shout', 'hi' );
