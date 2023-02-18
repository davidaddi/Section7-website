<?php 
include_once('inc/headHTML.php');
include_once('inc/nav.php');

include_once('controllers/registerController.php');

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
  <h2>S'Inscrire</h2>
  <div class="form-group">
    <label for="username">Pseudo* :</label>
    <div class="input-group">
      <input type="text" id="username" name="username" placeholder="Ton Pseudo" value="<?= $username ?? ''; ?>">
      <span class="icon"><i class="fa fa-user"></i></span>
    </div>
  </div>
  <div class="form-group">
    <label for="username">Email* :</label>
    <div class="input-group">
      <input type="text" id="email" name="email" placeholder="Ton Email" value="<?= $email ?? ''; ?>">
      <span class="icon"><i class="fa fa-at"></i></span>
    </div>
  </div>
  <div class="form-group">
    <label for="discord">Pseudo Discord* :</label>
    <div class="input-group">
      <input type="text" id="discord" placeholder="Pseudo#0000" name="discord" value="<?= $discord ?? ''; ?>">
      <span class="icon"><i class="fa-solid fa-lock"></i></span>
    </div>
  </div>
  <div class="form-group">
    <label for="github">Profil Github :</label>
    <div class="input-group">
      <input type="url" id="github" placeholder="https://github.com/legoatdegithub/" name="github" value="<?= $github ?? ''; ?>">
      <span class="icon"><i class="fab fa-github"></i></span>
    </div>
  </div>
  <div class="form-group">
    <label for="github">Mot de passe* :</label>
    <div class="input-group">
      <input type="password" id="password" placeholder="Votre mot de passe" name="password">
      <span class="icon"><i class="fab fa-lock"></i></span>
    </div>
  </div>
  <div class="form-group">
    <label for="github">Confirmer le mot de passe* :</label>
    <div class="input-group">
      <input type="password" id="github" placeholder="Confirmer votre mot de passe" name="confirmPassword">
      <span class="icon"><i class="fab fa-lock"></i></span>
    </div>
  </div>
  <button type="submit">S'INSCRIRE</button>
</main>