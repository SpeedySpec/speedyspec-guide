<?php
// Registers the Twenty Twenty-One pattern category; on init.
guide_theme( 'twentytwentyone' );
twenty_twenty_one_register_block_pattern_category();
return WP_Block_Pattern_Categories_Registry::get_instance()->get_registered( 'twentytwentyone' )['label'];
