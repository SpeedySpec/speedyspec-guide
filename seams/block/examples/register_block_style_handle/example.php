<?php
// Registers the stylesheet a block.json field names (a file: path, with its RTL version) and gives its handle; core blocks' styles may load from separate files.
$dir = get_temp_dir() . 'guide-block-' . getmypid();
wp_mkdir_p( $dir );
file_put_contents( "$dir/block.json", wp_json_encode( array( 'apiVersion' => 3, 'name' => 'guide/notice', 'title' => 'Notice', 'category' => 'text', 'attributes' => array( 'tone' => array( 'type' => 'string', 'default' => 'info' ) ), 'supports' => array( 'color' => array( 'background' => true ) ), 'style' => 'file:./style.css', 'editorScript' => 'file:./index.js' ) ) );
file_put_contents( "$dir/style.css", '.notice{}' );
file_put_contents( "$dir/index.js", '' );
file_put_contents( "$dir/index.asset.php", '<?php return array( "dependencies" => array( "wp-blocks" ), "version" => "1.0" );' );
$meta = wp_json_file_decode( "$dir/block.json", array( 'associative' => true ) );
$meta['file'] = "$dir/block.json";
$handle = register_block_style_handle( $meta, 'style' );
$result = array( $handle, wp_style_is( $handle, 'registered' ) );
array_map( 'unlink', glob( "$dir/*" ) );
rmdir( $dir );
return $result;
