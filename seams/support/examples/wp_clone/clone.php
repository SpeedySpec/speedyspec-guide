<?php
// A copy of an object, made with clone; deprecated in 3.2.0, from the days when PHP 4 copied objects on assignment.
$a = (object) array( 'x' => 1 );
$b = wp_clone( $a );
$b->x = 2;
return array( $a->x, $b->x );
