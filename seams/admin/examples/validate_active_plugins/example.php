<?php
// Deactivates active plugins whose files are gone, and gives their errors.
update_option( 'active_plugins', array( 'hello.php', 'gone/gone.php' ) );
$invalid = validate_active_plugins();
return array( array_keys( $invalid ), get_option( 'active_plugins' ) );
