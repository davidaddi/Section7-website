<?php
require('lib/db.php');
require('lib/testadmin.php');

if (!$isAdmin) {
    header('Location: index.php');
}

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'promote':
        $id = $_GET['id'];
        $req = $db->prepare('UPDATE users SET role=? WHERE id=?');
        $req->execute(['admin', $id]);
        header('Location: admin.php');
        break;

    case 'ban':
        $id = $_GET['id'];
        $req = $db->prepare('INSERT INTO bans SELECT * FROM users WHERE id=?');
        $req->execute([$id]);
        $req = $db->prepare('DELETE FROM users WHERE id=?');
        $req->execute([$id]);
        header('Location: admin.php');
        break;

    case 'remove':
        $id = $_GET['id'];
        $req = $db->prepare('UPDATE users SET role=? WHERE id=?');
        $req->execute(['user', $id]);
        header('Location: admin.php');
        break;

    case 'remove':
        $id = $_GET['id'];
        $req = $db->prepare('UPDATE users SET role=? WHERE id=?');
        $req->execute(['user', $id]);
        header('Location: admin.php');
        break;

    case 'deban':
        $id = $_GET['id'];
        $req = $db->prepare('INSERT INTO users SELECT * FROM abns WHERE id=?');
        $req->execute([$id]);
        $req = $db->prepare('DELETE FROM bans WHERE id=?');
        $req->execute([$id]);
        header('Location: admin.php');
        break;

    default:
        // afficher la liste des utilisateurs
        $users = $db->query('SELECT * FROM users')->fetchAll();
        include('admin_view.php');
        break;
}
?>