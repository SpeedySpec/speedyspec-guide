<?php
// Removes a role (users keep it on their accounts but lose its capabilities).
add_role( 'reviewer', 'Reviewer' );
remove_role( 'reviewer' );
return get_role( 'reviewer' );
