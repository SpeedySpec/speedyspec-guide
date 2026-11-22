<?php
// Registers a theme's languages folder for its text domain and returns true, the translations loading just in time; load_child_theme_textdomain() for the child theme.
switch_to_locale( 'fr_FR' );
return array( load_theme_textdomain( 'guide-theme' ), load_child_theme_textdomain( 'guide-child' ) );
