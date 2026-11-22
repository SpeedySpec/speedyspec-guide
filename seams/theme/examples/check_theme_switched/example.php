<?php
// Hooked to init: fires after_switch_theme (or the old theme's switch hook) once after a theme switch, then clears the flag.
switch_theme( 'twentytwentyfive' );
check_theme_switched();
return array( did_action( 'after_switch_theme' ), get_option( 'theme_switched' ) );
