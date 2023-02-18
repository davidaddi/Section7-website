<?php 
require_once('inc/headHTML.php');
require_once('inc/nav.php'); 

require_once('./lib/db.php');

if(!$isConnected) {
    header('Location: login.php');
}

if(!empty($_POST)) {
	$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

  	extract($post);

  	$errors = [];

  	if(!password_verify($actualPassword, $user['password'])) {
        $err = "Current wrong password.";
        $errors[] = $err;
  	}

  	if(empty($newPassword)){
	    $err = 'The password is required.';
        $errors[] = $err;
	}

    if(strlen($newPassword) < 6){
	    $err = 'The new password must contain at least 6 characters.';
        $errors[] = $err;
	}

	if($newPassword !== $confirmNewPassword){
		$err = 'The new passwords do not match.';
        $errors[] = $err;
	}

	if(empty($errors)) {
		$req = $db->prepare('UPDATE users SET password=:password WHERE id=:id');
		$req->bindValue(':password', password_hash($newPassword, PASSWORD_BCRYPT), PDO::PARAM_STR);
		$req->bindValue(':id', $user['id'], PDO::PARAM_INT);
		$req->execute();

		$success = 'Password updated !';
	}
}

?>

<main>
    <?php if(!empty($success)):?>
        <div class="alert alert-success"><p style="padding: 15px;"><?=$success;?></p></div>
    <?php endif;?>

    <?php if(!empty($errors)):?>
        <div class="alert alert-danger">
            <ul style="list-style-type: circle;">
                <?php foreach($errors as $error):?>
                    <li><?=$error;?></li>
                <?php endforeach;?>
            </ul>
        </div>
    <?php endif;?>

    <form class="form" method="POST">
        <h2>Changer mon mot de passe</h2>
        <div class="form-group">
            <label for="username">Mot de passe actuel :</label>
                <div class="input-group">
                <input type="password" id="username" placeholder="Votre mot de passe" name="actualPassword">
            </div>
        </div>
        <div class="form-group">
            <label for="password">Nouveau mot de passe :</label>
            <div class="input-group">
                <input type="password" id="newPassword" placeholder="Votre nouveau mot de passe" name="newPassword">
            </div>
        </div>
        <div class="form-group">
            <label for="password">Confirmer nouveau mot de passe :</label>
            <div class="input-group">
                <input type="password" id="confirmNewPassword" placeholder="Confirmer votre nouveau mot de passe" name="confirmNewPassword">
            </div>
        </div>
        <button type="submit">ENVOYER</button>
    </form>


</main>

?>


?>