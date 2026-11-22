<?php
// Starts a request for embeddings (vectors for search and similarity) of one or more inputs through the PHP AI Client: gives an embedding builder.
$builder = wp_ai_client_embedding( 'green tea', 'black tea' );
return get_class( $builder );
