<?php
// home and siteurl come back without a trailing slash.
update_option( 'home', 'http://example.org/' );
return get_option( 'home' );
