<?php
// Whether the user gets the visual editor: their rich_editing setting on (always for visitors) and a browser it supports, detected when WordPress loads; filtered by user_can_richedit.
$GLOBALS['is_chrome'] = true;
$on = user_can_richedit();
update_user_meta( 1, 'rich_editing', 'false' );
$GLOBALS['wp_rich_edit'] = null;
return array( $on, user_can_richedit() );
