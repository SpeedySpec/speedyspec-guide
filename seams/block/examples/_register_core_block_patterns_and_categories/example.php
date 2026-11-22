<?php
// Hooked to init: registers WordPress's own patterns (when the theme supports core-block-patterns) and pattern categories.
_register_core_block_patterns_and_categories();
return WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( 'banner' );
