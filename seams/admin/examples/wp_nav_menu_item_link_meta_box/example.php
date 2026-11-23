<?php
// Prints the Custom Links box: the URL and link text fields and the Add to Menu button.
$html = guide_render( fn() => wp_nav_menu_item_link_meta_box() );
return array( str_contains( $html, 'custom-menu-item-url' ), str_contains( $html, 'submit-customlinkdiv' ) );
