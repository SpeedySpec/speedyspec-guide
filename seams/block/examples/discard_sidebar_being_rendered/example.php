<?php
// Hooked to dynamic_sidebar_after: forgets the widget area noted.
note_sidebar_being_rendered( 'sidebar-1' );
discard_sidebar_being_rendered();
return isset( $GLOBALS['_sidebar_being_rendered'] ) ? $GLOBALS['_sidebar_being_rendered'] : 'unset';
