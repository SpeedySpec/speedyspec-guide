<?php
// A random integer between a minimum and maximum, from random_int().
$n = wp_rand( 5, 10 );
return $n >= 5 && $n <= 10;
