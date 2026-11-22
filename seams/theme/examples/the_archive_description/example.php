<?php
// Prints the archive's description with markup before and after.
wp_update_term( 1, 'category', array( 'description' => 'Everything else.' ) );
guide_go( '/?cat=1' );
return guide_render( fn() => the_archive_description( '<div>', '</div>' ) );
