<?php
// update_core, update_plugins and update_themes are read without checking their timeout.
set_site_transient( 'update_plugins', 'checked', 60 );
update_site_option( '_site_transient_timeout_update_plugins', time() - 1 );
return get_site_transient( 'update_plugins' );
