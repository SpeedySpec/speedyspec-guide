<?php
// Loads the theme's sidebar.php (or sidebar-{name}.php), falling back to the compatibility sidebar; fires get_sidebar.
guide_render( 'get_sidebar' );
return did_action( 'get_sidebar' );
