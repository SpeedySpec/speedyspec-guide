<?php
// Runs the changes that must happen before the schema upgrade, for sites whose database is older; does nothing on a current one.
$before = get_option( 'db_version' );
pre_schema_upgrade();
return get_option( 'db_version' ) === $before;
