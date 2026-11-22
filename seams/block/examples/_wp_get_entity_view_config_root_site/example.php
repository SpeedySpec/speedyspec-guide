<?php
// The view configuration of the site root entity.
$data = new WP_View_Config_Data( array() );
$result = _wp_get_entity_view_config_root_site( $data );
return get_class( $result );
