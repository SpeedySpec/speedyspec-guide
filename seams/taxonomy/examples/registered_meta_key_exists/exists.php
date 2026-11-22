<?php
// Whether a meta key is registered for a type and subtype.
register_meta( 'post', 'mood', array( 'object_subtype' => 'page' ) );
return array( registered_meta_key_exists( 'post', 'mood', 'page' ), registered_meta_key_exists( 'post', 'mood' ), registered_meta_key_exists( 'post', 'other', 'page' ) );
