<?php
// When comments get the strict kses filter, a span may keep only the wp-note-mention and user-<id> classes.
add_filter( 'pre_comment_content', 'wp_filter_kses' );
return wp_unslash( _wp_kses_sanitize_note_mention_classes( '<span class="wp-note-mention user-7 evil">@ada</span>' ) );
