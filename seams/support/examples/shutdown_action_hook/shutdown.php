<?php
// Fires shutdown, then closes the object cache; registered to run when PHP shuts down.
add_action( 'shutdown', fn() => print( "shutdown\n" ) );
shutdown_action_hook();
return 'done';
