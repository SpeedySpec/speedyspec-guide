<?php
// register_globals() copies the names into the old $weekday, $month… globals.
$GLOBALS['wp_locale']->register_globals();
return array( $GLOBALS['weekday'][1], $GLOBALS['month']['12'], $GLOBALS['weekday_initial']['Friday'], $GLOBALS['weekday_abbrev']['Sunday'], $GLOBALS['month_abbrev']['May'] );
