<?php
// The theme.json style nodes without those of blocks.
return array_values( wp_filter_out_block_nodes( array( array( 'path' => array( 'styles' ) ), array( 'path' => array( 'styles', 'blocks', 'core/paragraph' ) ), array( 'path' => array( 'styles', 'elements', 'link' ) ) ) ) );
