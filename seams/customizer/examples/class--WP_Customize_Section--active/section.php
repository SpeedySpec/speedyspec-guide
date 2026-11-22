<?php
// Sections and panels group controls in the pane, with a title, priority, capability and active state; prepare_controls() sorts them and keeps those the user may see, and the pane hides a section with no controls.
$wp = guide_customizer();
$wp->add_section( 'guide_empty', array( 'title' => 'Empty' ) );
$wp->prepare_controls();
return array( isset( $wp->sections()['guide_empty'] ), isset( $wp->sections()['title_tagline'] ), $wp->get_section( 'title_tagline' )->json()['title'] );
