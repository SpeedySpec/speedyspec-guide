<?php
// Prints a term's name as CDATA for the export; defined by export_wp().
guide_render( 'export_wp' );
return guide_render( fn() => wxr_term_name( get_term( 1 ) ) );
