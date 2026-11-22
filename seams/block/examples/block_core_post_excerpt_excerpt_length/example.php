<?php
// Hooked to excerpt_length in the admin: 101 words, more than the block's longest excerpt, so the editor's Post Excerpt block can trim excerpts itself.
return block_core_post_excerpt_excerpt_length();
