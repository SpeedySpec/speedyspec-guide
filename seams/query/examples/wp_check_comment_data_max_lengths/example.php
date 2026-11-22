<?php
// An error when a comment's author, email, URL or content is longer than its column allows.
return array( wp_check_comment_data_max_lengths( array( 'comment_author' => 'Ada', 'comment_content' => 'Hi' ) ), wp_check_comment_data_max_lengths( array( 'comment_author' => str_repeat( 'a', 300 ) ) )->get_error_code() );
