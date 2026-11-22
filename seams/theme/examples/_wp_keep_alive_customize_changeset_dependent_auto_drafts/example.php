<?php
// Hooked to transition_post_status: when a changeset is saved as a draft or scheduled, refreshes the dates of the auto-drafts it made, so they aren't deleted with old auto-drafts.
return has_action( 'transition_post_status', '_wp_keep_alive_customize_changeset_dependent_auto_drafts' );
