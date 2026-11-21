<?php
// The token never puts its HTML into JSON, and loses it when unserialized.
$token = wp_interactivity_as_dangerous_html( '<b>x</b>' );
add_action( 'doing_it_wrong_run', function () {} );
$copy = unserialize( serialize( $token ) );
return array( wp_json_encode( $token ), WP_Interactivity_Dangerous_HTML::get_html( $token ), WP_Interactivity_Dangerous_HTML::get_html( $copy ) );
