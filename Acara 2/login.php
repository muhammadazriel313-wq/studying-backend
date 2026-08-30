<?php
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
echo "Username yang dikirim: " . htmlspecialchars($username);
?>