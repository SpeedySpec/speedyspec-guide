<?php
// The IDs of a Tabs block's tabs, from the tab panels inside its tab-panels block: each panel's anchor, else the tabs ID with -tab-N.
$inner = parse_blocks( '<!-- wp:tab-panels --><div class="wp-block-tab-panels"><!-- wp:tab-panel {"anchor":"intro"} --><div class="wp-block-tab-panel"></div><!-- /wp:tab-panel --><!-- wp:tab-panel --><div class="wp-block-tab-panel"></div><!-- /wp:tab-panel --></div><!-- /wp:tab-panels -->' );
return block_core_tabs_generate_tabs_list( $inner, 'tabs-1' );
