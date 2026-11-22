<?php
// Says whether a tag is registered.
add_shortcode( 'greet', fn() => 'Hello' );
return array( shortcode_exists( 'greet' ), shortcode_exists( 'other' ) );
