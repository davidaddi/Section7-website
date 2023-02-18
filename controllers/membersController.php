
<?php require("inc/headHTML.php"); ?>
<?php require_once("inc/nav.php"); ?>

<?php 
require('./lib/db.php');

$user = isset($_SESSION["user"]) ? $_SESSION ['user'] : null;

if(empty($_SESSION['user'])){
  header('Location: login.php');
}

if(!empty($_POST)) {
	$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

  	extract($post);

  	$errors = [];

  	if(empty($username)){
	    $err = 'Veuillez entrer votre username';
        $errors[] = $err;
	}

    if(strlen($username) < 3){
	    $err = 'Le username doit avoir au moins 3 caractères';
        $errors[] = $err;
	}

    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $err = 'L\'email n\'est pas une adresse email valide.';
        $errors[] = $err;
    }

	if(empty($discord)){
        $err = 'Entrez un utilisateur Discord.';
        $errors[] = $err;
    }

	if(empty($errors)) {
		$req = $db->prepare('SELECT * FROM users WHERE username=:username AND id != :id');
		$req->bindValue(':username', $username, PDO::PARAM_STR);
		$req->bindValue(':id', $user['id'], PDO::PARAM_INT);
		$req->execute();

		if($req->rowCount() > 0){
			$err = 'Un autre utilisateur a déjà ce nom.';
            $errors[] = $err;
		}

		$req = $db->prepare('SELECT * FROM users WHERE email=:email AND id != :id');
		$req->bindValue(':email', $email, PDO::PARAM_STR);
		$req->bindValue(':id', $user['id'], PDO::PARAM_INT);
		$req->execute();

		if($req->rowCount() > 0){
			$err = 'Un autre utilisateur a déjà cet email.';
            $errors[] = $err;
		}

		$req = $db->prepare('SELECT * FROM users WHERE discord=:discord AND id != :id');
		$req->bindValue(':discord', $discord, PDO::PARAM_STR);
		$req->bindValue(':id', $user['id'], PDO::PARAM_INT);
		$req->execute();

		if($req->rowCount() > 0){
			$err = 'Ce profil Discord est déjà lié à un autre compte.';
            $errors[] = $err;
		}

		$req = $db->prepare('SELECT * FROM users WHERE github=:github AND id != :id');
		$req->bindValue(':github', $github, PDO::PARAM_STR);
		$req->bindValue(':id', $user['id'], PDO::PARAM_INT);
		$req->execute();

		if($req->rowCount() > 0){
			$err = 'Ce profil Github est déjà lié à un autre compte.';
            $errors[] = $err;
		}

		if(empty($errors)) {
			$req = $db->prepare('SELECT * FROM users WHERE id=:id');
			$req->bindValue(':id', $user['id'], PDO::PARAM_INT);
			$req->execute();

			$user = $req->fetch();

			$req = $db->prepare('UPDATE users SET username=:username, email=:email, discord=:discord, github=:github WHERE id=:id');
			$req->bindValue(':username', $username, PDO::PARAM_STR);
			$req->bindValue(':email', $email, PDO::PARAM_STR);
			$req->bindValue(':discord', $discord, PDO::PARAM_STR);
			$req->bindValue(':github', $github, PDO::PARAM_STR);
			$req->bindValue(':id', $user['id'], PDO::PARAM_INT);
			$req->execute();

			$req = $db->prepare('SELECT * FROM users WHERE id=:id');
			$req->bindValue(':id', $user['id'], PDO::PARAM_INT);
			$req->execute();

			$user = $req->fetch();

			unset($_SESSION['user']);
			$_SESSION['user'] = $user;

			$success = 'Informations mises à jour.';
		}
	}
}
?>