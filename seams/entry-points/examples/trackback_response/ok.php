<?php
// Prints a trackback's XML answer: error 0 for success, or error 1 with a message, after which it ends the request.
guide_load_functions( 'wp-trackback.php', 'trackback_response' );
trackback_response( 0 );
return null;
