<?php
// It replaces print_emoji_styles on wp_print_styles with an inline style; with print_emoji_styles not hooked there, it does nothing.
remove_action( 'wp_print_styles', 'print_emoji_styles' );
return wp_enqueue_emoji_styles();
