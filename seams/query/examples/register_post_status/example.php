<?php
// Registers a post status with its label, visibility (public, private, protected, internal) and list behaviour; the status object.
$status = register_post_status( 'archived', array( 'label' => 'Archived', 'public' => false, 'private' => true, 'show_in_admin_status_list' => true, 'label_count' => _n_noop( 'Archived (%s)', 'Archived (%s)' ) ) );
return array( $status->label, $status->private, $status->exclude_from_search, in_array( 'archived', get_post_stati(), true ) );
