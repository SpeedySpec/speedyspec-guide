<?php
// The site's timezone as a DateTimeZone.
update_option( 'gmt_offset', 2 );
return wp_timezone()->getName();
