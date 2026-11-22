<?php
// Updates a user's meta, adding it when missing.
$grace = guide_user();
return array( is_int( update_user_meta( $grace, 'color', 'blue' ) ), update_user_meta( $grace, 'color', 'blue' ), update_user_meta( $grace, 'color', 'red' ), get_user_meta( $grace, 'color', true ) );
