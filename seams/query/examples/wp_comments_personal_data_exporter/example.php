<?php
// Exports the comments left with an email for a privacy request, 500 a page: author, email, URL, IP, agent, date, content and link.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

$export = wp_comments_personal_data_exporter( 'ada@example.org' );
return array( $export['done'], array_column( $export['data'][0]['data'], 'name' ) );
