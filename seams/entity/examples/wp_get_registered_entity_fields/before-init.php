<?php
// Reading before init has completed is reported, and finds nothing.
function guide_report_doing_it_wrong( $function_name ) { echo "$function_name "; }
add_action( 'doing_it_wrong_run', 'guide_report_doing_it_wrong' );
return wp_get_registered_entity_fields( 'postType', 'book' );
