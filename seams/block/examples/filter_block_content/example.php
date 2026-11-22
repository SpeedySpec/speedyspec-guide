<?php
// Runs kses over the attribute values of each block in markup and its inner blocks, repairing broken delimiters; the blocks' HTML is left to the content filters.
return filter_block_content( '<!-- wp:paragraph {"x":"<script>alert(1)</script>"} --><p onclick="evil()">Hi</p><!-- /wp:paragraph -->', 'post' );
