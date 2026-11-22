<?php
// The Customizer manager: settings, panels, sections and controls registered by id (add_ and get_, remove_), sorted by priority for the pane; WordPress registers its own (site identity, colors, menus, widgets, homepage, CSS) with register_controls().
$wp = guide_customizer();
$wp->add_panel( 'guide_panel', array( 'title' => 'Guide' ) );
$wp->add_section( 'guide_section', array( 'title' => 'Look', 'panel' => 'guide_panel' ) );
$wp->add_setting( 'guide_color', array( 'default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp->add_control( 'guide_color', array( 'label' => 'Color', 'section' => 'guide_section', 'type' => 'text' ) );
return array( $wp->get_setting( 'guide_color' )->default, $wp->get_control( 'guide_color' )->section, $wp->get_section( 'guide_section' )->panel, array_slice( array_keys( $wp->sections() ), 0, 4 ), isset( $wp->settings()['blogname'] ) );
