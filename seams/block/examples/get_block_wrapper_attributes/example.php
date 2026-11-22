<?php
// The attributes string for the wrapper of the block being rendered: the classes, styles and other attributes its supports add, merged with extra ones.
register_block_type( 'guide/box', array( 'supports' => array( 'color' => array( 'background' => true ) ), 'render_callback' => 'guide_box_render' ) );
function guide_box_render( array $attributes ): string
{
	return '<div ' . get_block_wrapper_attributes( array( 'id' => 'box' ) ) . '>Box</div>';
}
return render_block( array( 'blockName' => 'guide/box', 'attrs' => array( 'backgroundColor' => 'contrast' ), 'innerBlocks' => array(), 'innerHTML' => '', 'innerContent' => array() ) );
