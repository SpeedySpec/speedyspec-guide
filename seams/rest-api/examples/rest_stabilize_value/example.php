<?php
// A value with every object's keys sorted, recursively, so equal values compare equal.
return rest_stabilize_value( array( 'b' => 1, 'a' => array( 'd' => 2, 'c' => 3 ) ) );
