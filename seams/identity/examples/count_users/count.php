<?php
// The number of users and of each role, counted in SQL by default (or in memory); pre_count_users can answer first.
$grace = guide_user();
guide_user( 'alan', 'author' );
guide_user( 'bea', 'author' );
return array( count_users(), count_users( 'memory' )['total_users'] );
