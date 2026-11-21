<?php
// wp_spaces_regexp filters it, once: the result is kept for the request.
add_filter( 'wp_spaces_regexp', fn() => ' ' );
return array( wp_spaces_regexp(), remove_all_filters( 'wp_spaces_regexp' ), wp_spaces_regexp() );
