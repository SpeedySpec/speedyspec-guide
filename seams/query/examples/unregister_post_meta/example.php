<?php
// Removes a meta key registered for posts of a type.
register_post_meta( 'post', 'rating', array( 'type' => 'integer' ) );
return array( unregister_post_meta( 'post', 'rating' ), unregister_post_meta( 'post', 'rating' ) );
