<?php
// Gives primary menu parents aria-haspopup and aria-expanded attributes; on nav_menu_link_attributes.
guide_theme( 'twentynineteen' );
return twentynineteen_nav_menu_link_attributes( array( 'href' => '#' ), (object) array( 'classes' => array( 'menu-item-has-children' ) ), (object) array( 'theme_location' => 'menu-1' ) );
