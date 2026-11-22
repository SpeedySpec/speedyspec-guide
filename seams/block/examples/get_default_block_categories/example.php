<?php
// The block categories WordPress has: text, media, design, widgets, theme, embed and reusable.
return array_column( get_default_block_categories(), 'slug' );
