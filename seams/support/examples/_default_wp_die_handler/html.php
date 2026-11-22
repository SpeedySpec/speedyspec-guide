<?php
// Prints the HTML error page for wp_die(): the status, the message, a back link when asked, and the title, then exits unless told not to.
$page = guide_render( fn() => _default_wp_die_handler( 'Something failed.', 'Oops', array( 'exit' => false, 'response' => 500, 'back_link' => true ) ) );
return array( str_contains( $page, '<title>Oops</title>' ), str_contains( $page, 'Something failed.' ), str_contains( $page, 'javascript:history.back()' ) );
