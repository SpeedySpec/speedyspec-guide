<?php
// Registers the script module a block.json field names (viewScriptModule) and gives its ID.
$dir = get_temp_dir() . 'guide-block-' . getmypid();
wp_mkdir_p( $dir );
file_put_contents( "$dir/block.json", wp_json_encode( array( 'apiVersion' => 3, 'name' => 'guide/notice', 'title' => 'Notice', 'category' => 'text', 'attributes' => array( 'tone' => array( 'type' => 'string', 'default' => 'info' ) ), 'supports' => array( 'color' => array( 'background' => true ) ), 'style' => 'file:./style.css', 'editorScript' => 'file:./index.js' ) ) );
file_put_contents( "$dir/style.css", '.notice{}' );
file_put_contents( "$dir/index.js", '' );
file_put_contents( "$dir/index.asset.php", '<?php return array( "dependencies" => array( "wp-blocks" ), "version" => "1.0" );' );
file_put_contents( "$dir/view.js", '' );
$meta = array( 'name' => 'guide/notice', 'file' => "$dir/block.json", 'viewScriptModule' => 'file:./view.js' );
$id = register_block_script_module_id( $meta, 'viewScriptModule' );
array_map( 'unlink', glob( "$dir/*" ) );
rmdir( $dir );
return $id;
