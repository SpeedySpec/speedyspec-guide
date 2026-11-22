<?php
// Hooked to render_block: makes a block's custom font size fluid in its markup when fluid typography is on.
return render_block( parse_blocks( '<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"}}} --><p class="wp-block-paragraph" style="font-size:18px">x</p><!-- /wp:paragraph -->' )[0] );
