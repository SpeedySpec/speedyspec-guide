<?php
// Marks the site as no longer fresh (fresh_site 0) once its content or settings change; attached to the hooks of those changes.
update_option( 'fresh_site', '1' );
_delete_option_fresh_site();
return get_option( 'fresh_site' );
