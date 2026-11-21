<?php
class Registers {
	public function __construct() {
		add_action( 'init', array( $this, 'on_init' ) );
		add_filter( 'the_title', array( self::class, 'title' ) );
		add_filter( 'the_excerpt', array( __CLASS__, 'excerpt' ) );
		add_filter( 'the_date', 'static::date' );
	}
}
