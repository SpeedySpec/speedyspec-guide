<?php
// When a Customizer changeset is deleted, deletes the auto-draft posts it created for menus and trashes those that became drafts.
$auto = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'Stub', 'post_status' => 'auto-draft' ) );
$draft = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'Kept', 'post_status' => 'draft' ) );
$changeset = wp_insert_post( array( 'post_type' => 'customize_changeset', 'post_status' => 'auto-draft', 'post_content' => wp_json_encode( array( 'nav_menus_created_posts' => array( 'value' => array( $auto, $draft ) ) ) ) ) );
_wp_delete_customize_changeset_dependent_auto_drafts( $changeset );
return array( get_post( $auto ), get_post_status( $draft ) );
