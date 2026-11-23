<?php
// Hooked to manage_edit-comments_columns in the Comments box: keeps only the author and comment columns.
return post_comment_meta_box_thead( array( 'cb' => '', 'author' => 'Author', 'comment' => 'Comment', 'response' => 'In response to', 'date' => 'Date' ) );
