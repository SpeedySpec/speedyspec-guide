<?php
// Registers the classic editor's TinyMCE scripts: wp-tinymce-root, wp-tinymce and the wp-tinymce-lists plugin.
$s = wp_scripts();
return array( isset( $s->registered['wp-tinymce'] ), $s->registered['wp-tinymce']->deps );
