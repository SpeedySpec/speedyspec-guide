<?php
class GuideCallback {
	public $data;
	public function __construct() {
		$this->data = range( 1, 1000 );
	}
	public function __invoke( $x ) {
		return $x . count( $this->data );
	}
}
\SpeedySpec\Hooks\Hook::add( 'guide_leak', new GuideCallback() );
return 1;
