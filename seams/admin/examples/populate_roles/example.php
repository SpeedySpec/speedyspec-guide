<?php
// Creates the default roles and capabilities: administrator, editor, author, contributor and subscriber.
remove_role( 'author' );
populate_roles();
return array_keys( wp_roles()->get_names() );
