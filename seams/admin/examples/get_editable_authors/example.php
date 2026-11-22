<?php
// Deprecated in 3.1.0; use get_users(). Gave the authors whose posts a user can edit.
list( $result, $notice ) = guide_deprecated( 'get_editable_authors', 1 );
return array( wp_list_pluck( $result, 'user_login' ), $notice );
