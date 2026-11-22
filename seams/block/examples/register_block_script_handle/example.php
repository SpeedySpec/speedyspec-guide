<?php
// Registers the script a block.json field names (a file: path with its .asset.php) and gives its handle; a handle as given otherwise.
$dir = get_temp_dir() . 'guide-block-' . getmypid();
wp_mkdir_p( $dir );
file_put_contents( "$dir/block.json", wp_json_encode( array( 'apiVersion' => 3, 'name' => 'guide/notice', 'title' => 'Notice', 'category' => 'text', 'attributes' => array( 'tone' => array( 'type' => 'string', 'default' => 'info' ) ), 'supports' => array( 'color' => array( 'background' => true ) ), 'style' => 'file:./style.css', 'editorScript' => 'file:./index.js' ) ) );
file_put_contents( "$dir/style.css", '.notice{}' );
file_put_contents( "$dir/index.js", '' );
file_put_contents( "$dir/index.asset.php", '<?php return array( "dependencies" => array( "wp-blocks" ), "version" => "1.0" );' );
$meta = wp_json_file_decode( "$dir/block.json", array( 'associative' => true ) );
$meta['file'] = "$dir/block.json";
$handle = register_block_script_handle( $meta, 'editorScript' );
$result = array( $handle, wp_scripts()->registered[ $handle ]->deps );
array_map( 'unlink', glob( "$dir/*" ) );
rmdir( $dir );
return $result;
