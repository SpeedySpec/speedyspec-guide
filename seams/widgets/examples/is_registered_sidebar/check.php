<?php
// Whether a sidebar ID is registered.
register_sidebar( array( 'id' => 'side', 'name' => 'Side' ) );
return array( is_registered_sidebar( 'side' ), is_registered_sidebar( 'other' ) );
