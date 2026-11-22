<?php
// Scales a width and height down, keeping the ratio, to fit within a maximum width and height; a zero maximum doesn't limit.
return array( wp_constrain_dimensions( 1200, 800, 300, 300 ), wp_constrain_dimensions( 1200, 800, 600 ), wp_constrain_dimensions( 200, 100, 300, 300 ) );
