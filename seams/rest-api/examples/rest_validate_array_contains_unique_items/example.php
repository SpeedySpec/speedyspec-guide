<?php
// Whether an array's items are all different, comparing values stably (key order of objects doesn't matter).
return array( rest_validate_array_contains_unique_items( array( 1, 2, 3 ) ), rest_validate_array_contains_unique_items( array( array( 'a' => 1, 'b' => 2 ), array( 'b' => 2, 'a' => 1 ) ) ) );
