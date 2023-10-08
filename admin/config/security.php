<?php
header("X-Frame-Options: DENY");

header("X-XSS-Protection: 1; mode=block");

header("Strict-Transport-Security:max-age=63072000");

header('X-Content-Type-Options: nosniff');
?>