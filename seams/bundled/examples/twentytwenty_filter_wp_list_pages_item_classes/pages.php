<?php
// Adds menu classes (current-menu-item, menu-item-has-children) to page list items, when the list asks to match menu classes; on page_css_class.
guide_theme( 'twentytwenty' );
return array( twentytwenty_filter_wp_list_pages_item_classes( array( 'page_item', 'current_page_item', 'page_item_has_children' ), null, 0, array( 'match_menu_classes' => true ) ), twentytwenty_filter_wp_list_pages_item_classes( array( 'current_page_item' ), null, 0, array() ) );
