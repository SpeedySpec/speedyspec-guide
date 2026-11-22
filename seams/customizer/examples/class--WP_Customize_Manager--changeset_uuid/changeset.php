<?php
// A Customizer session's changes are kept in a changeset, a customize_changeset post named by its UUID; save_changeset_post() writes the settings' values to it and, when published, applies them, then trashes the changeset.
$uuid = '1b2c3d4e-0000-4000-8000-000000000001';
$wp = guide_customizer( array( 'changeset_uuid' => $uuid ) );
$wp->set_post_value( 'blogname', 'Renamed' );
$saved = $wp->save_changeset_post( array( 'status' => 'publish' ) );
return array( $wp->changeset_uuid(), is_array( $saved ), get_option( 'blogname' ), get_post_status( $wp->changeset_post_id() ) );
