<?php
// Queues the script modules the block editor needs, such as the LaTeX to MathML loader.
wp_default_script_modules();
wp_enqueue_block_editor_script_modules();
return str_contains( guide_render( array( wp_script_modules(), 'print_enqueued_script_modules' ) ), 'latex-to-mathml' );
