<?php
// Ends the request with a message (or a WP_Error's messages), a title and a response code (500 by default), through the handler for the request type: AJAX, JSON, JSONP, XML-RPC, XML or the HTML page; the wp_die_*_handler filters pick it. Here the handlers throw.
return array( guide_dies( fn() => wp_die( 'Stop', 'Title', array( 'response' => 403 ) ) ), guide_dies( fn() => wp_die( new WP_Error( 'bad', 'Something failed.' ) ) )['message'] );
