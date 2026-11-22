<?php
// Queues a script for printing, registering it first when a source is given.
wp_enqueue_script( 'guide-new', 'https://cdn.example/new.js', array(), '1.0', true );
return array( wp_script_is( 'guide-new' ), wp_scripts()->get_data( 'guide-new', 'group' ) );
