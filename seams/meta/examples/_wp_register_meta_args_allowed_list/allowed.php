<?php
// On register_meta_args, keeps only the arguments register_meta() knows.
return array_keys( _wp_register_meta_args_allowed_list( array( 'type' => 'string', 'extra' => 1, 'single' => true ), array( 'type' => '', 'single' => false, 'default' => '' ) ) );
