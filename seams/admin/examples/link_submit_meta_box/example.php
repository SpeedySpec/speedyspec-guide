<?php
// Prints the link edit screen's Save box: visibility and the Add or Update and Delete buttons.
update_option( 'link_manager_enabled', 1 );
return str_contains( guide_render( fn() => link_submit_meta_box( get_default_link_to_edit() ) ), 'id="submitlink"' );
