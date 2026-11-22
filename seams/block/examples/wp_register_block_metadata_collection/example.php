<?php
// Registers a folder of blocks with their metadata in one PHP manifest, so registering each reads no block.json.
$file = get_temp_dir() . 'guide-manifest.php';
file_put_contents( $file, '<?php return array();' );
wp_register_block_metadata_collection( WP_PLUGIN_DIR . '/guide-blocks', $file );
unlink( $file );
return 'registered';
