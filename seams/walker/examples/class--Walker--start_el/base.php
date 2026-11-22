<?php
// The base class's start_lvl(), end_lvl(), start_el() and end_el() write nothing; a walker overrides them.
class Guide_Plain extends Walker { public $db_fields = array( 'parent' => 'parent', 'id' => 'id' ); }
return ( new Guide_Plain() )->walk( array( (object) array( 'id' => 1, 'parent' => 0 ) ), 0 );
