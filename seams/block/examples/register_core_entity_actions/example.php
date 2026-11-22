<?php
// Hooked to wp_entity_actions_api_init: registers WordPress's own actions for each post type shown in REST, by what it supports and what the user can do.
register_core_entity_actions();
return array_slice( wp_list_pluck( wp_get_registered_entity_actions( 'postType', 'post' ), 'id' ), 0, 5 );
