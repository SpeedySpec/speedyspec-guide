<?php
// add_option() only adds, update_option() adds or changes, delete_option() removes; each says whether it did.
return array(
	'add'        => add_option( 'guide_colour', 'blue' ),
	'add again'  => add_option( 'guide_colour', 'red' ),
	'after adds' => get_option( 'guide_colour' ),
	'update'     => update_option( 'guide_colour', 'green' ),
	'delete'     => delete_option( 'guide_colour' ),
	'after'      => get_option( 'guide_colour', 'none' ),
);
