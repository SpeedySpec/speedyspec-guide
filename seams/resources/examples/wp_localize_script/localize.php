<?php
// Prints a JavaScript object of data before a script, under a name; values are cast to strings (one level), and l10n_print_after is kept for compatibility.
wp_register_script( 'guide-app', 'https://cdn.example/app.js', array( 'jquery' ), '1.2' );
wp_localize_script( 'guide-app', 'guideConfig', array( 'url' => 'http://example.org/', 'count' => 3 ) );
return wp_scripts()->get_data( 'guide-app', 'data' );
