<?php
// A block's comment-delimited markup from its name, attributes and inner content, self-closing when empty.
return array( get_comment_delimited_block_content( 'core/paragraph', array( 'dropCap' => true ), '<p>Hi</p>' ), get_comment_delimited_block_content( 'core/spacer', array(), '' ) );
