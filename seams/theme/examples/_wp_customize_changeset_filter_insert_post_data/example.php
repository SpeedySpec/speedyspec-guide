<?php
// Hooked to wp_insert_post_data: keeps a changeset's post name (its UUID) and dates as given.
$data = _wp_customize_changeset_filter_insert_post_data( array( 'post_type' => 'customize_changeset', 'post_name' => 'abc', 'post_status' => 'future' ), array( 'post_name' => 'abc-uuid' ) );
return $data['post_name'];
