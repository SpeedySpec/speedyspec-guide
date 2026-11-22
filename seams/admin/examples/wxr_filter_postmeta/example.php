<?php
// Hooked to wxr_export_skip_postmeta: leaves _edit_lock out of the export.
guide_render( 'export_wp' );
return array( wxr_filter_postmeta( false, '_edit_lock' ), wxr_filter_postmeta( false, 'origin' ) );
