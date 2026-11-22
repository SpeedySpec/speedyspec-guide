<?php
// Starts a prompt to an AI model through the PHP AI Client: gives a prompt builder for adding text, files and settings before generating.
$builder = wp_ai_client_prompt( 'Summarize this post in one sentence.' );
return get_class( $builder );
