<?php
// Prints the link edit screen's Categories box: the checklist and the Add New form.
update_option( 'link_manager_enabled', 1 );
return str_contains( guide_render( fn() => link_categories_meta_box( get_default_link_to_edit() ) ), 'categorychecklist' );
