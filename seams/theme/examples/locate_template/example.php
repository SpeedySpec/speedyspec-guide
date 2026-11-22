<?php
// Finds the first of some template files in the child theme, then the parent, then theme-compat, and loads it when asked; '' when none exists.
switch_theme( 'twentytwentyone' );
wp_set_template_globals();
return array( str_replace( get_theme_root(), '<themes>', locate_template( array( 'nope.php', 'page.php' ) ) ), locate_template( 'nope.php' ) );
