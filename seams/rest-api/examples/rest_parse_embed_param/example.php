<?php
// The _embed parameter as true for everything, or the list of link relations to embed.
return array( rest_parse_embed_param( '1' ), rest_parse_embed_param( 'author,wp:term' ), rest_parse_embed_param( array( 'author' ) ) );
