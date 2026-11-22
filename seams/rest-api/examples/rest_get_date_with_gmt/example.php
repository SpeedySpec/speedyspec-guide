<?php
// A date given in REST as the local and GMT MySQL dates, in the site's time zone; null when it isn't a date.
update_option( 'gmt_offset', 2 );
return array( rest_get_date_with_gmt( '2026-01-02T10:00:00' ), rest_get_date_with_gmt( '2026-01-02T10:00:00', true ), rest_get_date_with_gmt( 'nope' ) );
