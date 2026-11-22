<?php
// Hooked to render_block: adds the aspect ratio class and style to a block's wrapper.
return render_block( parse_blocks( '<!-- wp:cover {"style":{"dimensions":{"aspectRatio":"16/9"}}} --><div class="wp-block-cover"></div><!-- /wp:cover -->' )[0] );
