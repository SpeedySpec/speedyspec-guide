<?php
// Hooked to heartbeat_settings: adds the AJAX URL and, outside the admin, the nonce settings the Heartbeat script needs.
return array_keys( wp_heartbeat_settings( array() ) );
