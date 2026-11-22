<?php
// Sets the text domain (and folder) of a script's translations, which are printed before it when found; the script then depends on wp-i18n.
wp_register_script( 'guide-app', 'https://cdn.example/app.js', array( 'jquery' ), '1.2' );
$set = wp_set_script_translations( 'guide-app', 'guide' );
return array( $set, wp_scripts()->registered['guide-app']->textdomain, in_array( 'wp-i18n', wp_scripts()->registered['guide-app']->deps, true ) );
