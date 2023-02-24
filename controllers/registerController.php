<?php 

require("./lib/db.php"); 

$isConnected = isset($_SESSION["user"]);
$user = isset($_SESSION["user"]) ? $_SESSION ['user'] : null;

if($isConnected) {
    header('Location: index.php');
}

if(!empty($_POST)) {
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    extract($post);

    $errors = [];

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err = 'Entrez une adresse email valide.';
        $errors[] = $err;
    }

    $req = $db->prepare("SELECT * FROM users WHERE email='$email'");
    $req->execute();

    if($req->rowCount() > 0){
        $err = 'Votre email est déjà utilisée';
        $errors[] = $err;
    }

    $req = $db->prepare("SELECT * FROM bans WHERE email='$email' OR discord='$discord' OR github='$github'");
    $req->execute();

    if($req->rowCount() > 0){
        $err = 'Vous êtes bannis de la Section 7, il est impossible pour vous de vous inscrire.';
        $errors[] = $err;
    }

    if (empty($username)) {
        $err = 'Entrez un nom d\'utilisateur.';
        $errors[] = $err;
    }

    if(strlen($username) < 3) {
        $err = 'Le nom d\'utilisateur doit contenir au moins 3 caractères.';
        $errors[] = $err;
    }


    $req = $db->prepare("SELECT * FROM users WHERE username='$username'");
    $req->execute();

    if($req->rowCount() > 0){
        $err = 'Ce nom d\'utilisateur est déjà utilisé.';
        $errors[] = $err;
    }

    $req = $db->prepare("SELECT * FROM users WHERE discord='$discord'");
    $req->execute();

    if($req->rowCount() > 0){
        $err = 'Ce profil Discord est déjà associé a un autre profil.';
        $errors[] = $err;
    }

    if (empty($password)) {
        $err = 'Entrez votre mot de passe.';
        $errors[] = $err;
    }


    if(strlen($password) < 6) {
        $err = 'Le mot de passe doit contenir au moins 6 caractères';
        $errors[] = $err;
    }

    if (empty($confirmPassword)) {
        $err = 'Confirmez le mot de passe.';
        $errors[] = $err;
    }

    if ($confirmPassword != $password) {
        $err = 'Les deux mots de passes ne sont pas identiques.';
        $errors[] = $err;
    }

    if(empty($discord)) {
        $err = 'Entrez votre pseudo Discord';
        $errors[] = $err;
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($errors)) {
        $credentials = $_POST;

        $rand = rand();
        $token = md5($rand);


        $stmt = $db->prepare('INSERT INTO users (username, email, discord, github, password, token) VALUES (:username, :email, :discord, :github, :password, :token)');
        $stmt->execute([
            "username"=>$credentials['username'],
            "email"=>$credentials['email'],
            "discord"=>$credentials['discord'],
            "github"=>$credentials['github'],
            "password" => password_hash($credentials['password'], PASSWORD_BCRYPT),
            "token" => $token
        ]);

        $token = base64_encode($token);

        $success = 'Vous êtes bien inscrit, <a href="connexion.php"><u>vous pouvez vous connecter ici</u></a>.';
    }
}


?>