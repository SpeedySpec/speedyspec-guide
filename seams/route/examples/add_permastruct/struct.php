<?php
// Adds a named structure that rewrite_rules() turns into rules; the old fourth argument is the endpoint mask. remove_permastruct() removes it.
add_permastruct( 'guide', '/guides/%guide%', array( 'with_front' => false ) );
add_permastruct( 'old', '/old/%old%', true, EP_PERMALINK );
$r = $GLOBALS['wp_rewrite'];
$guide = $r->extra_permastructs['guide'];
$mask = $r->extra_permastructs['old']['ep_mask'];
remove_permastruct( 'old' );
return array( $guide, $mask, isset( $r->extra_permastructs['old'] ) );
