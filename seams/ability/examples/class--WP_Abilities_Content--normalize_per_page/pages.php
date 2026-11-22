<?php
// 10 a page, or 100 when listing IDs or slugs, unless per_page says otherwise, never more than 100.
guide_core_abilities();
$content = new WP_Abilities_Content();
return array( guide_private( $content, 'normalize_per_page', array(), false ), guide_private( $content, 'normalize_per_page', array(), true ), guide_private( $content, 'normalize_per_page', array( 'per_page' => '500' ), false ), guide_private( $content, 'normalize_per_page', array( 'per_page' => 0 ), false ) );
