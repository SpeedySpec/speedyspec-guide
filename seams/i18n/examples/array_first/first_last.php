<?php
// PHP 8.5's array_first() and array_last(), polyfilled before: the first and last values, or null for an empty array.
return array( array_first( array( 'b' => 2, 'a' => 1 ) ), array_last( array( 3, 4 ) ), array_first( array() ) );
