<?php
// Registers every block of a metadata collection: the manifest registered first, then each block from its folder.
return wp_register_block_types_from_metadata_collection( WP_PLUGIN_DIR . '/no-blocks', get_temp_dir() . 'missing-manifest.php' );
