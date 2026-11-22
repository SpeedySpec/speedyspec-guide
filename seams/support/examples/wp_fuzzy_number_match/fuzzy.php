<?php
// Whether two numbers are within a precision of each other, 1 by default.
return array( wp_fuzzy_number_match( 10, 10.9 ), wp_fuzzy_number_match( 10, 12 ), wp_fuzzy_number_match( 1.0, 1.04, 0.05 ) );
