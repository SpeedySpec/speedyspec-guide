<?php
// Hooked to init: gives the AI client the API key of each AI provider connector that has one, from its environment variable, constant or option.
_wp_connectors_pass_default_keys_to_ai_client();
return did_action( 'init' ) > 0;
