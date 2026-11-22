<?php
// Ends an XML request for wp_die(): the code, title, message and data in an <error> document.
return guide_render( fn() => _xml_wp_die_handler( 'Failed.', 'Oops', array( 'exit' => false, 'response' => 400 ) ) );
