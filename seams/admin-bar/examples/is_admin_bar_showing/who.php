<?php
// Never for XML-RPC, Ajax, iframes, JSON or embeds; always in the admin; on the front end for a logged-in user whose preference allows it.
$logged_out = is_admin_bar_showing();
unset( $GLOBALS['show_admin_bar'] );
guide_log_in( array( 'read' => true ) );
return array( $logged_out, is_admin_bar_showing() );
