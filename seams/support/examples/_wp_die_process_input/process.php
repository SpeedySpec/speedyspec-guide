<?php
// Turns wp_die()'s message, title and arguments into what the handlers print: a WP_Error's messages and data, the default title and response, and the back link, text direction and charset.
list( $message, $title, $args ) = _wp_die_process_input( new WP_Error( 'bad', 'Failed.', array( 'status' => 404 ) ) );
return array( $message, $title, $args['response'], $args['code'], $args['text_direction'] );
