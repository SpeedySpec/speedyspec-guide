<?php
// Unregisters a plugin's block template.
register_block_template( 'guide//landing', array( 'title' => 'Landing' ) );
return array( get_class( unregister_block_template( 'guide//landing' ) ), unregister_block_template( 'guide//landing' )->get_error_code() );
