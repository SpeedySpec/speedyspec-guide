<?php
// Deactivates the REST API feature plugin at version 2.0-beta4 or older during a core update.
_upgrade_440_force_deactivate_incompatible_plugins();
return get_option( 'active_plugins' );
