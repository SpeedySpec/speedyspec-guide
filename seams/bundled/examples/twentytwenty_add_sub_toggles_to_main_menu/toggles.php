<?php
// Wraps menu items in the modal menu (show_toggles) in an ancestor wrapper with a sub menu toggle button for parents; in the primary menu, parents get an icon span. On nav_menu_item_args.
guide_theme( 'twentytwenty' );
$modal = twentytwenty_add_sub_toggles_to_main_menu( (object) array( 'show_toggles' => true, 'theme_location' => 'expanded' ), (object) array( 'ID' => 7, 'classes' => array( 'menu-item-has-children' ) ) );
$primary = twentytwenty_add_sub_toggles_to_main_menu( (object) array( 'theme_location' => 'primary' ), (object) array( 'ID' => 8, 'classes' => array( 'menu-item-has-children' ) ) );
return array( $modal->before, str_contains( $modal->after, 'data-toggle-target=".menu-modal .menu-item-7 > .sub-menu"' ), $primary->after );
