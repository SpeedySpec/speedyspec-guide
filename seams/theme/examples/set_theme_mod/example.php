<?php
// Sets one of the active theme's modifications; filtered by pre_set_theme_mod_{$name}.
set_theme_mod( 'accent', 'red' );
return get_option( 'theme_mods_' . get_option( 'stylesheet' ) );
