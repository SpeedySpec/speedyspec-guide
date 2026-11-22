<?php
// On a 404, guesses a post from the requested name. do_redirect_guess_404_permalink can turn it off, pre_redirect_guess_404_permalink answer instead, and with no name there is nothing to guess.
$none = redirect_guess_404_permalink();
function guide_guessed_permalink() {
	return 'http://example.org/guessed/';
}
add_filter( 'pre_redirect_guess_404_permalink', 'guide_guessed_permalink' );
$pre = redirect_guess_404_permalink();
add_filter( 'do_redirect_guess_404_permalink', '__return_false' );
return array( $none, $pre, redirect_guess_404_permalink() );
