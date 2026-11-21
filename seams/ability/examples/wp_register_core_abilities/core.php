<?php
// WordPress's own abilities. core/settings-get is registered only when a setting is exposed to abilities, and core/content-query only when a post type is.
guide_core_abilities();
register_setting( 'general', 'blogname', array( 'show_in_abilities' => true, 'type' => 'string', 'label' => 'Site Title' ) );
return array_map( fn( $a ) => $a->get_category() . ' ' . implode( ',', $a->get_required_capabilities() ), wp_get_abilities() );
