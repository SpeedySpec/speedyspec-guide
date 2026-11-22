<?php
// The post type, looked up on every call, or null when it isn't exposed to abilities.
guide_core_abilities();
$content = new WP_Abilities_Content();
register_post_type( 'guide_hidden', array( 'public' => true, 'rewrite' => false, 'query_var' => false ) );
return array( guide_private( $content, 'get_exposed_post_type', 'guide_note' )->name, guide_private( $content, 'get_exposed_post_type', 'guide_hidden' ), guide_private( $content, 'get_exposed_post_type', 5 ) );
