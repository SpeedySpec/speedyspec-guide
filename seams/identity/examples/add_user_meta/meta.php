<?php
// User meta, like post meta: add_user_meta(), get_user_meta(), update_user_meta(), delete_user_meta().
$grace = guide_user();
add_user_meta( $grace, 'skill', 'php' );
add_user_meta( $grace, 'skill', 'sql' );
$all = get_user_meta( $grace, 'skill' );
update_user_meta( $grace, 'skill', 'go', 'php' );
delete_user_meta( $grace, 'skill', 'sql' );
return array( $all, get_user_meta( $grace, 'skill' ), add_user_meta( $grace, 'lang', 'en', true ), add_user_meta( $grace, 'lang', 'fr', true ) );
