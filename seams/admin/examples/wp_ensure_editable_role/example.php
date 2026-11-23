<?php
// Stops with an error when the current user may not give a role, before it is assigned.
return wp_ensure_editable_role( 'editor' );
