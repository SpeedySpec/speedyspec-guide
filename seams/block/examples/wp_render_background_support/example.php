<?php
// Hooked to render_block: adds a block's background image, size, position, repeat and attachment as inline styles on its wrapper.
return render_block( parse_blocks( '<!-- wp:group {"style":{"background":{"backgroundImage":{"url":"http://example.org/bg.jpg"},"backgroundSize":"cover"}}} --><div class="wp-block-group"></div><!-- /wp:group -->' )[0] );
