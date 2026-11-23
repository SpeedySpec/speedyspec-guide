<?php
// Prints a term's meta as wp:termmeta elements for the export, leaving out keys wxr_export_skip_termmeta skips; defined by export_wp().
guide_render( 'export_wp' );
add_term_meta( 1, 'color', 'green' );
return guide_render( fn() => wxr_term_meta( get_term( 1 ) ) );
