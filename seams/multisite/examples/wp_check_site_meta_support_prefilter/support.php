<?php
// Stops site meta calls with an error message when site meta isn't supported (before the 5.1 database upgrade); otherwise passes the value on.
return wp_check_site_meta_support_prefilter( null );
