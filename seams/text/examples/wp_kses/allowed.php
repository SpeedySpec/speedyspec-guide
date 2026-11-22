<?php
// Keeps only the elements and attributes allowed. On trunk it parses with the HTML API, so a disallowed script goes with its contents.
return wp_kses( '<p class="x" onclick="bad()">Hi <script>alert(1)</script><b>there</b></p>', array( 'p' => array( 'class' => true ) ) );
