<?php
// Whether a plugin can clean up on uninstall: it has an uninstall.php or registered an uninstall hook.
return is_uninstallable_plugin( 'hello.php' );
