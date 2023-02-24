<?php 
include_once('inc/headHTML.php');
include_once('inc/nav.php');

include_once('controllers/loginController.php');

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
<form class="form forgotPassword" method="POST">
  <h2>Se connecter</h2>
  <div class="form-group">
    <label for="username">Pseudo :</label>
    <div class="input-group">
      <input type="text" id="username" placeholder="Votre pseudo" name="username" value="<?= $username ?? ''; ?>">
      <span class="icon"><i class="fa fa-user"></i></span>
    </div>
  </div>
  <div class="form-group">
    <label for="password">Mot de passe :</label>
    <div class="input-group">
      <input type="password" id="password" placeholder="Votre mot de passe" name="password">
      <span class="icon"><i class="fab fa-lock"></i></span>
    </div>
    <p style="color: #ff5c00; margin-top: 20px;"><a href="forgotPassword.php">Mot de passe oublié ?</a>
  </div>
  <button type="submit">SE CONNECTER</button>
</main>