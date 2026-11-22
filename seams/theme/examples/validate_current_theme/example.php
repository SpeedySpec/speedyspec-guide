<?php
// Hooked to setup_theme: switches back to the default theme when the active one is broken (no index.php or missing parent), for front-end requests.
return array( validate_current_theme(), get_option( 'stylesheet' ) );
