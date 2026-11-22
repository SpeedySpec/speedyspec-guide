<?php
// Registers the Checkmark style for List blocks; on init.
guide_theme( 'twentytwentyfive' );
twentytwentyfive_block_styles();
return WP_Block_Styles_Registry::get_instance()->get_registered( 'core/list', 'checkmark-list' )['label'];
