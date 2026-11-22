<?php
// Hooked to render_block_context: gives the Tabs and Tab List blocks their list of tabs in context, built once.
$tabs = parse_blocks( '<!-- wp:tabs --><div class="wp-block-tabs"><!-- wp:tab {"label":"One"} --><div class="wp-block-tab"></div><!-- /wp:tab --></div><!-- /wp:tabs -->' )[0];
return array_keys( block_core_tabs_provide_context( array(), $tabs ) );
