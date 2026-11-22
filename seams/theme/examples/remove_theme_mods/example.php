<?php
// Removes every modification of the active theme.
set_theme_mod( 'accent', 'red' );
remove_theme_mods();
return get_theme_mods();
