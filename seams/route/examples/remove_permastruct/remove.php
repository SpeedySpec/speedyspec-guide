<?php
// Removes a named structure.
add_permastruct( 'guide', '/guides/%guide%' );
remove_permastruct( 'guide' );
return $GLOBALS['wp_rewrite']->get_extra_permastruct( 'guide' );
