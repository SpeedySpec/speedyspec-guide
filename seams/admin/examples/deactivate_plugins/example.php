<?php
// Deactivates plugins, running their deactivation hooks unless silent, and removes them from active_plugins.
activate_plugin( 'hello.php' );
deactivate_plugins( 'hello.php' );
return get_option( 'active_plugins' );
