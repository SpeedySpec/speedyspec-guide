<?php
// Formats a timestamp (or now) with month and weekday names translated; the timestamp is taken as local time unless GMT is asked for. date_i18n filters the result.
return array( date_i18n( 'l, F jS Y', 1772355600 ), date_i18n( 'D M', 1772355600 ) );
