<?php
// Prints the admin notice that a newer WordPress is available, linking to the updates screen for users who can update.
guide_offer_core_update( '7.3' );
$GLOBALS['pagenow'] = 'index.php';
return wp_strip_all_tags( guide_render( 'update_nag' ) );
