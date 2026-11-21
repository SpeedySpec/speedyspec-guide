<?php
// pre_update_option_{$option} can change the value before it is saved.
add_filter( 'pre_update_option_blogname', fn( $value ) => strtoupper( $value ) );
update_option( 'blogname', 'loud' );
return get_option( 'blogname' );
