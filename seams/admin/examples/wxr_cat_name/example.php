<?php
// Prints a category's name as CDATA for the export; defined by export_wp().
guide_render( 'export_wp' );
return guide_render( fn() => wxr_cat_name( get_term( 1 ) ) );
