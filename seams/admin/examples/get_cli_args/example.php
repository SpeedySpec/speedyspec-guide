<?php
// The value of a --name=value argument when an importer runs from the command line, or stops when a required one is missing.
$_SERVER['argv'] = array( 'import.php', '--file=export.xml', '--verbose' );
return array( get_cli_args( 'file' ), get_cli_args( 'verbose' ), get_cli_args( 'missing' ) );
