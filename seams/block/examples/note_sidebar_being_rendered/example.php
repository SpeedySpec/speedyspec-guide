<?php
// Hooked to dynamic_sidebar_before: notes the widget area being rendered, for the Widget Group block.
note_sidebar_being_rendered( 'sidebar-1' );
return $GLOBALS['_sidebar_being_rendered'];
