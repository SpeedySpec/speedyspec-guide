<?php
// Whether a state sets its own background image or gradient, which needs the inherited text clip undone.
return array( wp_state_paints_own_background( array( 'color' => array( 'gradient' => 'linear-gradient(red,blue)' ) ) ), wp_state_paints_own_background( array( 'color' => array( 'background' => 'red' ) ) ) );
