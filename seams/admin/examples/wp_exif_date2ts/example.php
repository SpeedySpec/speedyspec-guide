<?php
// Turns an EXIF date such as 2026:03:15 10:30:00 into a Unix timestamp.
return wp_exif_date2ts( '2026:03:15 10:30:00' ) === strtotime( '2026-03-15 10:30:00' );
