<?php 

require("./lib/db.php"); 

if($isConnected) {
    header("Location: index.php");
}

if (!empty($_POST)) {
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    extract($post);

    $errors = [];

    if(empty($username)) {
        $err = "Entrez un nom d'utilisateur.";
        $errors[] = $err;
    }

    if(empty($password)) {
        $err = 'Entrez un mot de passe.';
        $errors[] = $err;
    }
}

/* LOGIN */

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($errors)) {
        $credentials = $_POST;

        $stmt = $db->prepare('SELECT * FROM users WHERE username=:username');
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute([
            "username" => $credentials['username']
        ]);

        $req = $db->prepare('SELECT * FROM bans WHERE username=:username');
        $req->bindValue(':username', $username, PDO::PARAM_STR);
        $req->execute([
            "username" => $credentials['username']
        ]);
    
        $banned = $req->fetch();
        $user = $stmt->fetch();

        if($banned) {
            $err = 'Vous êtes bannis.';
            $errors[] = $err;
        } else {
            if($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header('Location: index.php');
            } else {
                $err = 'Nom d\'utilisateur ou mot de passe incorrect.';
                $errors[] = $err;
            }
        }
    }
}

?>