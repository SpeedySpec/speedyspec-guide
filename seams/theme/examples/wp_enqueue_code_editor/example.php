<?php
// Enqueues CodeMirror with settings for a file type or MIME type, unless the user turned syntax highlighting off; the settings, or false.
$settings = wp_enqueue_code_editor( array( 'type' => 'text/css' ) );
return array( $settings['codemirror']['mode'], wp_script_is( 'code-editor', 'enqueued' ) );
