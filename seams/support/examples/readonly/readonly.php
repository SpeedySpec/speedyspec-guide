<?php
// The readonly attribute when two values match, deprecated in 5.9.0 for wp_readonly(). WordPress loads it only on PHP before 8.1, where readonly isn't yet a keyword, so on this PHP it doesn't exist.
return array( PHP_VERSION_ID >= 80100, function_exists( 'readonly' ), wp_readonly( 1, 1, false ) );
