<?php
// The view configuration of pages.
$data = new WP_View_Config_Data( array() );
$result = _wp_get_entity_view_config_posttype_page( $data );
return get_class( $result );
