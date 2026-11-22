<?php
// Without item_spacing discard, levels and items are indented with tabs and newlines.
function guide_item( $id, $title, $parent = 0, $extra = array() ) { return (object) ( $extra + array( 'ID' => $id, 'db_id' => $id, 'menu_item_parent' => $parent, 'title' => $title, 'url' => "http://example.org/$id", 'classes' => array( 'menu-item' ), 'target' => '', 'xfn' => '', 'attr_title' => '', 'current' => false ) ); }
$args = (object) array( 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'item_spacing' => 'discard' );
$args->item_spacing = 'preserve';
return ( new Walker_Nav_Menu() )->walk( array( guide_item( 1, 'Home' ), guide_item( 2, 'Docs', 1 ) ), 0, $args );
