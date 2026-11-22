<?php
// Turns on pretty permalinks at install when the server serves them, trying /%year%/%monthnum%/%day%/%postname%/ and then with index.php; gives whether it did.
update_option( 'permalink_structure', '' );
return wp_install_maybe_enable_pretty_permalinks();
