<?php
// The columns the user hid on a screen, or the screen's default hidden ones; filtered by hidden_columns.
update_user_option( get_current_user_id(), 'manageedit-postcolumnshidden', array( 'tags' ) );
return get_hidden_columns( 'edit-post' );
