<?php
// A plugin's first hook.
add_action( 'admin_notices', fn() => print( 'Hello' ) );
do_action( 'admin_notices' );
