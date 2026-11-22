<?php
// The entity actions and entity fields controllers give the actions and fields registered for an entity (kind and name, such as postType page) on wp_entity_actions_api_init and wp_entity_fields_api_init, with the script modules that supply their JavaScript parts.
add_action( 'wp_entity_actions_api_init', fn() => wp_register_entity_actions( 'guide', 'postType', 'page', array( array( 'id' => 'guide-archive', 'label' => 'Archive', 'supportsBulk' => true ) ) ) );
$data = guide_rest( 'GET', '/wp/v2/entity-actions', array( 'kind' => 'postType', 'name' => 'page' ) )[1];
return array( in_array( 'guide-archive', array_column( $data['actions'], 'id' ), true ), array_keys( $data ), guide_rest( 'GET', '/wp/v2/entity-actions', array( 'kind' => 'postType', 'name' => 'nope' ) )[1]['code'] );
