<?php
// Unregisters a block pattern.
register_block_pattern( 'guide/cta', array( 'title' => 'CTA', 'content' => 'x' ) );
return array( unregister_block_pattern( 'guide/cta' ), unregister_block_pattern( 'guide/cta' ) );
