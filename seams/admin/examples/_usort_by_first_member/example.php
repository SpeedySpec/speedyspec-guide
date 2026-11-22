<?php
// Sorts importers by their name, the first member of each, for get_importers().
$importers = array( 'b' => array( 'Blogger' ), 'a' => array( 'LiveJournal' ), 'c' => array( 'Atom' ) );
uasort( $importers, '_usort_by_first_member' );
return array_keys( $importers );
