<?php
// A user query: arguments over the defaults (blog, role, meta, include and exclude, search with its columns, orderby, paging, fields, counts), turned into SQL and run; pre_user_query can change the SQL and users_pre_query answer instead.
$grace = guide_user();
guide_user( 'alan', 'author' );
$q = new WP_User_Query( array( 'role__in' => array( 'editor', 'author' ), 'orderby' => 'login', 'count_total' => true, 'fields' => array( 'user_login' ) ) );
$search = new WP_User_Query( array( 'search' => '*race*', 'search_columns' => array( 'user_login' ), 'fields' => 'ID' ) );
return array( wp_list_pluck( $q->get_results(), 'user_login' ), $q->get_total(), $search->get_results() == array( $grace ), $q->get( 'orderby' ) );
