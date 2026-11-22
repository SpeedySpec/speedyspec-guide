<?php
// Registers a block type from its block.json (a folder or file): reads and translates the metadata, registers its scripts, styles and modules from file: paths, and the render file; filtered by block_type_metadata and block_type_metadata_settings.
$dir = get_temp_dir() . 'guide-block-' . getmypid();
wp_mkdir_p( $dir );
file_put_contents( "$dir/block.json", wp_json_encode( array( 'apiVersion' => 3, 'name' => 'guide/notice', 'title' => 'Notice', 'category' => 'text', 'attributes' => array( 'tone' => array( 'type' => 'string', 'default' => 'info' ) ), 'supports' => array( 'color' => array( 'background' => true ) ), 'style' => 'file:./style.css', 'editorScript' => 'file:./index.js' ) ) );
file_put_contents( "$dir/style.css", '.notice{}' );
file_put_contents( "$dir/index.js", '' );
file_put_contents( "$dir/index.asset.php", '<?php return array( "dependencies" => array( "wp-blocks" ), "version" => "1.0" );' );
$type = register_block_type_from_metadata( $dir );
$result = array( $type->name, $type->attributes['tone']['default'], $type->editor_script_handles, $type->style_handles, wp_style_is( 'guide-notice-style', 'registered' ) );
array_map( 'unlink', glob( "$dir/*" ) );
rmdir( $dir );
return $result;
