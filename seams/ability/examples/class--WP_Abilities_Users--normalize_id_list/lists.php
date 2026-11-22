<?php
// ID and string lists from arrays or comma-separated strings; invalid and repeated IDs are dropped, and non-strings in string lists.
guide_core_abilities();
$users = new WP_Abilities_Users();
return array( guide_private( $users, 'normalize_id_list', '3, 3, x, 0, 5' ), guide_private( $users, 'normalize_string_list', array( 'a', 1, 'b' ) ), guide_private( $users, 'normalize_string_list', 5 ) );
