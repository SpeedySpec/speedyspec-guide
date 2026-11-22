<?php
// What an example prints is compared too, separately from what it returns.
function guide_print_greeting() {
	echo esc_html__( 'Hello from an example.', 'my-plugin' );
}
guide_print_greeting();
return null;
