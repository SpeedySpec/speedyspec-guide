<?php
// A state style without its nested state keys.
return wp_get_root_state_style( array( 'color' => array( 'text' => 'red' ), ':hover' => array( 'color' => array( 'text' => 'blue' ) ) ), array( ':hover' ) );
