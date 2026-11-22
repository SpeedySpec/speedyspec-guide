<?php
// The seconds since timer_start(), formatted with the given precision (printed too when asked); the $timeend global is set.
$GLOBALS['timestart'] = microtime( true ) - 2.5;
$time = timer_stop( 0, 1 );
return array( $time, number_format_i18n( 2.5, 1 ) === $time || '2.6' === $time );
