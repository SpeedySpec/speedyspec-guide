<?php
// Hooked to render_block_core/image: restores an aligned Image block's outer div for classic themes that rely on it.
return wp_restore_image_outer_container( '<figure class="wp-block-image alignright"><img src="a.jpg"/></figure>', array( 'blockName' => 'core/image', 'attrs' => array( 'align' => 'right' ) ) );
