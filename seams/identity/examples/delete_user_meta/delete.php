<?php
// Deletes a user's meta for a key, only a value when given.
$grace = guide_user();
add_user_meta( $grace, 'skill', 'php' );
return array( delete_user_meta( $grace, 'skill' ), get_user_meta( $grace, 'skill' ) );
