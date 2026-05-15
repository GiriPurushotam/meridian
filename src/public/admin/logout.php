<?php

/**
 * logout.php -- Admin logout
 * 
 * Destroy the session entirely and sends the user back to login page.
 * Accessed via a "Sign Out" link in the admin panel.
 */

session_start();
session_unset();
session_destroy();

header('Location: /admin/index.php');
exit;
