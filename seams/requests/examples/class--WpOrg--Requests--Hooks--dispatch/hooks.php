<?php
// Hooks run callbacks by priority, lowest first; dispatch() reports whether any ran.
$hooks = new WpOrg\Requests\Hooks();
$hooks->register( 'h', function () { echo "second\n"; }, 10 );
$hooks->register( 'h', function () { echo "first\n"; }, -5 );
try { $hooks->register( 5, 'trim' ); } catch ( WpOrg\Requests\Exception\InvalidArgument $e ) { echo $e->getMessage(), "\n"; }
return array( $hooks->dispatch( 'h' ), $hooks->dispatch( 'none' ) );
