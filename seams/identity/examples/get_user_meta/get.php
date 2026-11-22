<?php
// A user's meta: all keys, one key's values, or one value.
$grace = guide_user();
return array( get_user_meta( $grace, 'nickname', true ), get_user_meta( $grace, 'guide_capabilities', true ), get_user_meta( $grace, 'missing', true ) );
