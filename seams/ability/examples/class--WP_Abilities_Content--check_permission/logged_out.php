<?php
// It needs a logged-in user, an exposed post type, and the capabilities for any status asked for.
guide_core_abilities();
$content = new WP_Abilities_Content();
return array( guide_private( $content, 'check_permission', array( 'where' => array( 'type' => 'guide_note' ) ) ), wp_get_ability( 'core/content-query' )->execute( array( 'where' => array( 'type' => 'guide_note' ) ) )->get_error_code() );
