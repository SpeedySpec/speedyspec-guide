<?php
// Activates a theme: its stylesheet and template options and name, moving its widgets and theme mods; fires switch_theme, and after_switch_theme on the next load.
switch_theme( 'twentytwentyfive' );
return array( get_option( 'stylesheet' ), get_option( 'template' ), get_option( 'current_theme' ), get_option( 'theme_switched' ), did_action( 'switch_theme' ) );
