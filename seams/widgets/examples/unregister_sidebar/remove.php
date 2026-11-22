<?php
// Removes a sidebar; is_registered_sidebar() says whether one is registered.
register_sidebar( array( 'id' => 'side', 'name' => 'Side' ) );
$before = is_registered_sidebar( 'side' );
unregister_sidebar( 'side' );
return array( $before, is_registered_sidebar( 'side' ) );
