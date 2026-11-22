<?php
// Hooked to content_save_pre: slashed content with the custom CSS removed from every block's style attribute, changing only those attributes and keeping it slashed.
return wp_strip_custom_css_from_blocks( '<!-- wp:paragraph {"style":{"css":"color: red;"}} --><p class="wp-block-paragraph">Hi</p><!-- /wp:paragraph -->' );
