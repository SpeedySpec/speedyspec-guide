<?php
// The base controller: a namespace and rest_base, routes registered by register_routes(), and the CRUD callbacks, permission checks, schema and collection parameters subclasses fill in; the base gives errors for anything not overridden.
class Guide_Things_Controller extends WP_REST_Controller {
	protected $namespace = 'guide/v1';
	protected $rest_base = 'things';
	public function register_routes() {
		register_rest_route( $this->namespace, '/' . $this->rest_base, array(
			array( 'methods' => 'GET', 'callback' => array( $this, 'get_items' ), 'permission_callback' => '__return_true', 'args' => $this->get_collection_params() ),
			'schema' => array( $this, 'get_public_item_schema' ),
		) );
	}
	public function get_items( $request ) {
		$items = array( array( 'id' => 1, 'name' => 'one' ), array( 'id' => 2, 'name' => 'two' ) );
		return rest_ensure_response( array_map( fn( $i ) => $this->prepare_response_for_collection( $this->prepare_item_for_response( $i, $request ) ), $items ) );
	}
	public function prepare_item_for_response( $item, $request ) {
		return rest_ensure_response( $this->filter_response_by_context( $item, $request['context'] ?? 'view' ) );
	}
	public function get_item_schema() {
		return $this->add_additional_fields_schema( array( '$schema' => 'http://json-schema.org/draft-04/schema#', 'title' => 'thing', 'type' => 'object', 'properties' => array( 'id' => array( 'type' => 'integer', 'context' => array( 'view' ) ), 'name' => array( 'type' => 'string', 'context' => array( 'edit' ) ) ) ) );
	}
}
$guide_things = new Guide_Things_Controller();
add_action( 'rest_api_init', array( $guide_things, 'register_routes' ) );
return array( guide_rest( 'GET', '/guide/v1/things' ), array_keys( guide_rest( 'GET', '/guide/v1/things', array( 'context' => 'edit' ) )[1][0] ), $guide_things->get_item( new WP_REST_Request() )->get_error_code() );
