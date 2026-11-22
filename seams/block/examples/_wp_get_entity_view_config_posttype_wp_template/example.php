<?php
// The view configuration of templates.
$data = new WP_View_Config_Data( array() );
$result = _wp_get_entity_view_config_posttype_wp_template( $data );
return get_class( $result );
