<?php
// A Customizer control: the field for a setting in a section, of a type (text, checkbox, radio, select, textarea, dropdown-pages and more), printed by render_content() and exported to the pane by json().
$wp = guide_customizer();
$wp->add_setting( 'guide_choice', array( 'default' => 'b' ) );
$control = new WP_Customize_Control( $wp, 'guide_choice', array( 'label' => 'Pick', 'section' => 'title_tagline', 'type' => 'radio', 'choices' => array( 'a' => 'A', 'b' => 'B' ) ) );
$html = guide_render( fn() => ( fn() => $this->render_content() )->call( $control ) );
return array( substr_count( $html, 'type="radio"' ), str_contains( $html, 'checked' ), $control->json()['type'], $control->active() );
