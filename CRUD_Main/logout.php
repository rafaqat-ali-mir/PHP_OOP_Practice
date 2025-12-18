<?php
session_start();       // Start the session
session_destroy();     // Destroy all session data (logs the user out)
header("Location: login.php"); // Redirect user to login page
exit;                  // Stop executing the rest of the page
?>
