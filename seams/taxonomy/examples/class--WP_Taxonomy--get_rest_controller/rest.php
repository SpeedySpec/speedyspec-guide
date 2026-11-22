<?php
// The taxonomy's REST controller (WP_REST_Terms_Controller by default), created once, when it is shown in the REST API and the class exists; null otherwise, as here, where the REST controllers aren't loaded.
register_taxonomy( 'hidden_tax', 'post', array( 'show_in_rest' => false ) );
return array( get_taxonomy( 'category' )->show_in_rest, get_taxonomy( 'category' )->get_rest_controller(), get_taxonomy( 'hidden_tax' )->get_rest_controller() );
