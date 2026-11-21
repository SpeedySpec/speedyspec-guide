<?php
// Supplies a registered default, unless the caller passed its own.
register_setting( 'guide', 'guide_color', array( 'default' => 'blue' ) );
return array(
	filter_default_option( false, 'guide_color', false ),
	filter_default_option( 'red', 'guide_color', true ),
	filter_default_option( false, 'guide_unregistered', false ),
);
