<?php
// PHP has its own stripos(), so class-pop3.php's fallback is never defined: the function in use is PHP's.
return ( new ReflectionFunction( 'stripos' ) )->isInternal();
