<?php
// Hooked to render_block: adds a block's position class and styles to its wrapper, when the theme allows that position type (theme.json position settings).
return render_block( parse_blocks( '<!-- wp:group {"style":{"position":{"type":"sticky","top":"0px"}}} --><div class="wp-block-group"></div><!-- /wp:group -->' )[0] );
