<?php
// Hooked to render_block_core/details: sets fetchpriority=low on images inside a collapsed Details block.
$block = array( 'blockName' => 'core/details', 'attrs' => array() );
return block_core_details_set_img_fetchpriority_low( '<details><summary>More</summary><img src="a.jpg" alt=""></details>', $block );
