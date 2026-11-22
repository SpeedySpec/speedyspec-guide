<?php
// PHP 8's string checks, polyfilled before: an empty needle is always contained, and starts and ends every string.
return array( str_contains( 'WordPress', 'Press' ), str_contains( 'a', '' ), str_starts_with( 'WordPress', 'Word' ), str_starts_with( 'a', '' ), str_ends_with( 'WordPress', 'press' ), str_ends_with( '', '' ) );
