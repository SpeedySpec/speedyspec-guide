<?php
// Removes one of the active theme's modifications, and the option when none are left.
set_theme_mod( 'accent', 'red' );
remove_theme_mod( 'accent' );
return get_theme_mods();
