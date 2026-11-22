<?php
// Adds auto to the start of a lazy-loaded img tag's sizes attribute, when it has a width, so the browser picks the size; filtered by wp_img_tag_add_auto_sizes.
return array( wp_img_tag_add_auto_sizes( '<img src="a.jpg" width="300" loading="lazy" sizes="(max-width: 300px) 100vw, 300px">' ), wp_img_tag_add_auto_sizes( '<img src="a.jpg" width="300" sizes="300px">' ) );
