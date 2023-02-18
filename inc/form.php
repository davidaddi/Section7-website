<?php 

require('lib/db.php');

$stmt = $db->prepare('SELECT * FROM missions_desc WHERE statut="A"');
$stmt->execute();
$row = $stmt->fetch();

/* ERRORS */
if(!empty($_POST)) {
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    extract($post);

    $errors = [];

    if (empty($user)) {
        $err = 'Entrez un nom d\'utilisateur';
        $errors[] = $err;
    }

    if(empty($discord)) {
        $err = 'Entrez votre pseudo Discord';
        $errors[] = $err;
    }

    $req = $db->prepare("SELECT * FROM missions_submissions WHERE lien_repo_github='$lien_repo_github'");
    $req->execute();

    if($req->rowCount() > 0){
        $err = 'Vous avez déjà soumis ce projet.';
        $errors[] = $err;
    }

    if (empty($lien_repo_github)) {
        $err = 'Veuillez fournir le repo Github de votre projet.';
        $errors[] = $err;
    }
}

/* REGISTER */

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($errors)) {
        $credentials = $_POST;

        $stmt = $db->prepare('INSERT INTO missions_submissions (user, nomMission, discord, lien_repo_github) VALUES (:user, :nomMission,:discord, :lien_repo_github)');
        $stmt->execute([
            "user"=>$credentials['user'],
            "nomMission"=>$credentials['nomMission'],
            "discord"=>$credentials['discord'],
            "lien_repo_github"=>$credentials['lien_repo_github']
        ]);
        $success = 'Nous avons bien reçu votre projet.';
    }
}

?>

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
  <h2>Envoie-nous ton projet</h2>
  <div class="form-group">
    <label for="username">Pseudo :</label>
    <div class="input-group">
      <input type="text" id="username" name="user" placeholder="Ton Pseudo" required>
      <span class="icon"><i class="fa fa-user"></i></span>
    </div>
  </div>
  <div class="form-group">
    <label for="discord">Pseudo Discord :</label>
    <div class="input-group">
      <input type="text" id="discord" placeholder="Pseudo#0000" name="discord" required>
      <span class="icon"><i class="fab fa-discord"></i></span>
    </div>
  </div>
  <div class="form-group">
    <label for="github">Lien vers repo Github :</label>
    <div class="input-group">
      <input type="url" id="github" placeholder="https://github.com/legoatdegithub/superprojet" name="lien_repo_github" required>
      <span class="icon"><i class="fab fa-github"></i></span>
    </div>
    
        
    <div class="formRadio">
      <input type="radio" id="forMission" name="nomMission" value="<?php echo $row['nomMission'];?>" checked>
      <label for="forMission"><?php echo($row['nomMission']);?> (Mission en cours)</label>
    </div>
  <button type="submit">ENVOYER</button>
</form>