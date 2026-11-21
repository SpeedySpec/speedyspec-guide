<?php
// A walker that writes the tree as brackets, over items with id and parent.
class Guide_Walker extends Walker {
	public $db_fields = array( 'parent' => 'parent', 'id' => 'id' );
	public function start_lvl( &$output, $depth = 0, $args = array() ) { $output .= '['; }
	public function end_lvl( &$output, $depth = 0, $args = array() ) { $output .= ']'; }
	public function start_el( &$output, $data_object, $depth = 0, $args = array(), $current_object_id = 0 ) { $output .= $data_object->id . ( $this->has_children ? '+' : '' ); }
	public function end_el( &$output, $data_object, $depth = 0, $args = array() ) { $output .= ' '; }
}
function guide_item( $id, $parent = 0 ) { return (object) array( 'id' => $id, 'parent' => $parent ); }
$items = array( guide_item( 1 ), guide_item( 2, 1 ), guide_item( 3, 2 ), guide_item( 4 ), guide_item( 5, 1 ) );
$walker = new Guide_Walker();
// Depth 0 is every level, 1 the top level only, -1 every item flat; a depth under -1 gives ''.
return array( $walker->walk( $items, 0 ), $walker->walk( $items, 1 ), $walker->walk( $items, 2 ), $walker->walk( $items, -1 ), $walker->walk( $items, -2 ) );
