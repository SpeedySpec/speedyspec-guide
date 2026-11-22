<?php
// Reads a collection's field definitions, by id, without registering them.
$dir = sys_get_temp_dir() . '/guide-collection-' . getmypid() . '/read';
@mkdir( "$dir/pages", 0777, true );
file_put_contents( "$dir/pages/field.php", "<?php return array( 'label' => 'Pages' );" );
return wp_get_entity_field_collection_fields( $dir );
