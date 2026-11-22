<?php
// The view configuration of template parts.
$data = new WP_View_Config_Data( array() );
$result = _wp_get_entity_view_config_posttype_wp_template_part( $data );
return get_class( $result );
