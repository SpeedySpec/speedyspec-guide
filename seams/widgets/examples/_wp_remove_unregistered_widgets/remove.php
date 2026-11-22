<?php
// Keeps only allowed widget IDs (by default, the registered ones) in each sidebar.
return _wp_remove_unregistered_widgets( array( 'side' => array( 'a-2', 'b-2' ), 'flag' => true ), array( 'b-2' ) );
