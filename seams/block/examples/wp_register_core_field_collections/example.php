<?php
// Hooked to wp_entity_fields_api_init: registers WordPress's own fields: the defaults, then the single post types' collections, then the others.
wp_register_core_field_collections();
return array_slice( wp_list_pluck( wp_get_registered_entity_fields( 'postType', 'wp_template' ), 'id' ), 0, 5 );
