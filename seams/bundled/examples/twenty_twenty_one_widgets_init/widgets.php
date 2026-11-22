<?php
// Registers the Footer sidebar (sidebar-1); on widgets_init.
guide_theme( 'twentytwentyone' );
twenty_twenty_one_widgets_init();
$sidebar = $GLOBALS['wp_registered_sidebars']['sidebar-1'];
return array( $sidebar['name'], $sidebar['before_title'] );
