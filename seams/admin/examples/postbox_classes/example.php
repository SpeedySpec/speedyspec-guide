<?php
// The classes of a box on an edit screen: closed when the user collapsed it, plus those from postbox_classes_{$screen_id}_{$box_id}.
update_user_option( get_current_user_id(), 'closedpostboxes_post', array( 'postcustom' ) );
return array( postbox_classes( 'postcustom', 'post' ), postbox_classes( 'submitdiv', 'post' ) );
