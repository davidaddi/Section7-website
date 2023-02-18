<?php

require_once('lib/db.php');

$isConnected = isset($_SESSION["user"]);
$isAdmin = false;

if ($isConnected) {
  $stmt = $db->prepare('SELECT role FROM users WHERE id = :id');
  $stmt->execute([':id' => $_SESSION["user"]["id"]]);
  $user = $stmt->fetch();

  if ($user["role"] === "admin") {
    $isAdmin = true;
  }
}

?>
