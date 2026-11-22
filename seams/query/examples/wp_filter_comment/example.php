<?php
// Filters a new comment's fields through their pre_* filters: user ID, agent, author, content, IP, URL and email.
$data = wp_filter_comment( array( 'comment_author' => ' <b>Ada</b> ', 'comment_author_email' => 'ada@example.org', 'comment_author_url' => 'example.org', 'comment_content' => '<script>x</script>Hi', 'comment_author_IP' => '1.2.3.4', 'comment_agent' => 'Agent', 'user_id' => 0 ) );
return array( $data['comment_author'], $data['comment_author_url'], $data['comment_content'] );
