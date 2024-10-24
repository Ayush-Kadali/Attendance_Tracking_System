<?php
$password = 'your_new_password_here';
$hashed = password_hash($password, PASSWORD_DEFAULT);
echo "Hashed password: " . $hashed;

// SQL to update password
echo "\n\nSQL to update password:\n";
echo "UPDATE students SET password = '" . $hashed . "' WHERE prn = 'PRN_HERE';";
?>
