<?php
// Hooked to _wp_post_revision_fields: adds footnotes to the fields the revisions screen compares.
return wp_add_footnotes_to_revision( array( 'post_title' => 'Title' ) );
