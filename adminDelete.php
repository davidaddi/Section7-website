<?php
require('lib/db.php');
require('lib/testadmin.php');

if(!$isAdmin) {
    header('Location: index.php');
}

$req = $db->prepare('
INSERT INTO bans SELECT * FROM users WHERE id='.$_GET['id'].';
DELETE FROM users WHERE id='.$_GET['id'].';
');
$req->execute();
header('Location: admin.php');


?>