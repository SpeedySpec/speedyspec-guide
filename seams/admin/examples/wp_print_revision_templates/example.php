<?php
// Prints the Underscore templates of the revisions screen.
require_once ABSPATH . 'wp-admin/includes/revision.php';
return str_contains( guide_render( 'wp_print_revision_templates' ), 'tmpl-revisions-frame' );
