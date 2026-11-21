<?php
// Whether an array's keys are 0, 1, 2… in order (PHP 8.1's, polyfilled before).
return array( array_is_list( array( 'a', 'b' ) ), array_is_list( array( 1 => 'a' ) ), array_is_list( array() ) );
