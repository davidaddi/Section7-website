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
    
        $user = $stmt->fetch();

        if($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: index.php');
        }

        $err = 'Mauvais identifiants.';
        $errors[] = $err;
    }
}

?>