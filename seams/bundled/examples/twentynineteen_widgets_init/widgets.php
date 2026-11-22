<?php
// Registers the Footer sidebar (sidebar-1); on widgets_init.
guide_theme( 'twentynineteen' );
twentynineteen_widgets_init();
return $GLOBALS['wp_registered_sidebars']['sidebar-1']['name'];
