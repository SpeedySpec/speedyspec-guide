<?php
// Prints the archive's title with markup before and after.
guide_go( '/?cat=1' );
return guide_render( fn() => the_archive_title( '<h1>', '</h1>' ) );
