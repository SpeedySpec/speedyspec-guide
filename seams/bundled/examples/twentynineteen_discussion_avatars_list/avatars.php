<?php
// Prints a list of the comment authors' avatars; nothing without authors.
guide_theme( 'twentynineteen' );
$html = guide_render( fn() => twentynineteen_discussion_avatars_list( array( 1, 'ada@example.org' ) ) );
return array( substr_count( $html, '<li>' ), str_starts_with( $html, '<ol class="discussion-avatar-list">' ), guide_render( fn() => twentynineteen_discussion_avatars_list( array() ) ) );
