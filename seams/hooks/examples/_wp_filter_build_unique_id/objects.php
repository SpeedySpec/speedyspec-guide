<?php
// An object's callbacks are keyed by the object, so two live objects of one class are two callbacks.
class Guide_Callbacks {
	public function run() {}
}
$first  = new Guide_Callbacks();
$second = new Guide_Callbacks();
$a      = _wp_filter_build_unique_id( 'guide', array( $first, 'run' ), 10 );
$b      = _wp_filter_build_unique_id( 'guide', array( $second, 'run' ), 10 );

return $a === $b;
