<?php
// Registers the core blocks' metadata collection from its PHP manifest.
wp_register_core_block_metadata_collection();
return WP_Block_Metadata_Registry::get_metadata( ABSPATH . WPINC . '/blocks/paragraph' )['name'];
