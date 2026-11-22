<?php
// Enqueues the comments list's keyboard shortcuts when the user turned them on in their profile.
update_user_meta( get_current_user_id(), 'comment_shortcuts', 'true' );
enqueue_comment_hotkeys_js();
return wp_script_is( 'jquery-table-hotkeys', 'enqueued' );
