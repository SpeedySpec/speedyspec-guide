<?php
// Hooked to pre_get_posts when the site editor asks which template a new post uses: makes the main query find the auto-draft by its ID; other queries pass.
return array( _resolve_template_for_new_post( new WP_Query() ), has_action( 'pre_get_posts', '_resolve_template_for_new_post' ) );
