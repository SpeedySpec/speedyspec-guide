<?php
// Formats a Unix timestamp (or now) in a timezone, the site's by default, with month and weekday names translated; wp_date filters it.
return array( wp_date( 'Y-m-d H:i T', 1772355600 ), wp_date( 'Y-m-d H:i', 1772355600, new DateTimeZone( 'Asia/Tokyo' ) ) );
