<?php
// Merges one state style object over another, recursively.
return wp_merge_state_style_objects( array( 'color' => array( 'text' => 'red', 'background' => 'white' ) ), array( 'color' => array( 'text' => 'blue' ) ) );
