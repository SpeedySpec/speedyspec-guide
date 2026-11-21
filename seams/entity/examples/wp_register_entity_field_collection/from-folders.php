<?php
// A collection is a folder: index.php says whose fields they are, and each subfolder's field.php defines one, its id defaulting to the folder's name.
$dir = sys_get_temp_dir() . '/guide-collection-' . getmypid() . '/book';
@mkdir( "$dir/isbn", 0777, true );
file_put_contents( "$dir/index.php", "<?php return array( 'origin' => 'my-plugin', 'kind' => 'postType', 'name' => 'book' );" );
file_put_contents( "$dir/isbn/field.php", "<?php return array( 'label' => 'ISBN' );" );
add_action( 'wp_entity_fields_api_init', function () use ( $dir ) {
	echo var_export( wp_register_entity_field_collection( $dir ), true ), ' ';
} );
do_action( 'init' );
return array_column( wp_get_registered_entity_fields( 'postType', 'book' ), 'label', 'id' );
