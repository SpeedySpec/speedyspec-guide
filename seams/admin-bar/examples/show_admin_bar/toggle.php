<?php
// Sets whether the admin bar shows on the front end, over the user's preference; show_admin_bar filters the answer.
guide_log_in( array( 'read' => true ) );
show_admin_bar( false );
$off = is_admin_bar_showing();
show_admin_bar( true );
$on = is_admin_bar_showing();
add_filter( 'show_admin_bar', '__return_false' );
return array( $off, $on, is_admin_bar_showing() );
