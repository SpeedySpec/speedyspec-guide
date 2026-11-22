<?php
// Deactivates Gutenberg older than 17.6 during a core update and records it in wp_force_deactivated_plugins.
_upgrade_core_deactivate_incompatible_plugins();
return get_option( 'wp_force_deactivated_plugins', array() );
