<?php
// An error not from a plugin or theme is refused; one from an extension on a page that isn't protected (the front end) is refused too, so no email is sent.
$mode = new WP_Recovery_Mode();
return array( $mode->handle_error( array( 'file' => '/srv/site/wp-includes/load.php' ) )->get_error_code(), $mode->handle_error( array( 'file' => '/srv/site/wp-content/plugins/broken/broken.php', 'line' => 1, 'message' => 'x', 'type' => E_ERROR ) )->get_error_code() );
