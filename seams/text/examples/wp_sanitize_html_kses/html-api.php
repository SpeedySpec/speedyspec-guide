<?php
// On trunk, kses through the HTML API: it parses the markup as a browser would and keeps the allowed elements and attributes. Unlike wp_kses(), a disallowed script's contents go too, not just its tags.
return wp_sanitize_html_kses( '<p class="x" onclick="bad()">Hi <script>alert(1)</script><b>there</b></p>', array( 'p' => array( 'class' => true ), 'b' => array() ) );
