<?php
// Deprecated in 3.3.0: it renders one item with _render_item().
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f $v\n" ), 10, 3 );
$bar = new WP_Admin_Bar();
$bar->recursive_render( 'x', (object) array( 'id' => 'x', 'type' => 'item', 'parent' => 'root', 'children' => array(), 'href' => false, 'title' => 'X', 'icon' => false, 'meta' => array() ) );
return null;
