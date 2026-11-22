<?php
// Deprecated in 3.3.0: it renders one item with _render_item().
function guide_print_deprecated_function( $function_name, $replacement, $version ) {
	echo "$function_name $version\n";
}
add_action( 'deprecated_function_run', 'guide_print_deprecated_function', 10, 3 );
$bar = new WP_Admin_Bar();
$bar->recursive_render( 'x', (object) array( 'id' => 'x', 'type' => 'item', 'parent' => 'root', 'children' => array(), 'href' => false, 'title' => 'X', 'icon' => false, 'meta' => array() ) );
return null;
