<?php
// Registers the Footer #1 and Footer #2 sidebars; on widgets_init.
guide_theme( 'twentytwenty' );
twentytwenty_sidebar_registration();
return array( $GLOBALS['wp_registered_sidebars']['sidebar-1']['name'], $GLOBALS['wp_registered_sidebars']['sidebar-2']['name'] );
