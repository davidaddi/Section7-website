<?php require_once('controllers/membersController.php'); 

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
        <h2>Bienvenue, <?= $user['username'] ?></h2>
        <div class="form-group">
            <label for="username">Changer de pseudo :</label>
                <div class="input-group">
                <input type="text" id="username" placeholder="Votre nouveau pseudo" name="username" value="<?= $user['username'] ?? ''; ?>">
            <span class="icon"><i class="fa fa-user"></i></span>
            </div>
        </div>
        <div class="form-group">
            <label for="password">Changer l'email :</label>
            <div class="input-group">
                <input type="text" id="password" placeholder="Votre nouvelle adresse mail" name="email" value="<?= $user['email'] ?? ''; ?>">
                <span class="icon"><i class="fab fa-at"></i></span>
            </div>
        </div>
        <div class="form-group">
            <label for="password">Changer de Discord:</label>
            <div class="input-group">
                <input type="text" placeholder="Votre nouvelle adresse mail" name="discord" value="<?= $user['discord'] ?? ''; ?>">
                <span class="icon"><i class="fab fa-discord"></i></span>
            </div>
        </div>
        <div class="form-group">
            <label for="password">Changer de Github:</label>
            <div class="input-group">
                <input type="text" placeholder="Votre nouvelle adresse mail" name="github" value="<?= $user['github'] ?? ''; ?>">
                <span class="icon"><i class="fab fa-github"></i></span>
            </div>
        </div>
        <button type="submit">ENVOYER</button>
    </form>

    <div class="dashboardBtns" style="margin-top: 24px;">
        <button class='btn-danger' onclick="return confirm('Confirmer la suppression du compte ?');">
            <a href="suppressionCompte.php" class="delete" style="color: #fff">Supprimer mon compte</a>
        </button>
        
        <a href="changerMDP.php" style="color: #fff">Changer mon mot de passe</a>
    </div>

    <h1 class="newSectionH1">Mes soumissions</h1>
    <table id="usersTable">
        <tr>
            <th>Mission</th>
            <th>Date de soumission</th>
            <th>Repo Github</th>
            <th>Commentaire</th>
        </tr>
        <?php 

        $stmt = $db->prepare('SELECT * FROM missions_submissions WHERE user="'.$user['username'].'"');
        $stmt->execute();

        $submissions = $stmt->fetchAll();
        
        foreach($submissions as $submission) {
            echo'<tr>
            <td>'.$submission['nomMission'].'</td>
            <td>'.$submission['dateDepot'].'</td>
            <td>'.$submission['lien_repo_github'].'</td>
            <td>'.$submission['commentaire'].'</td>
        </tr>';
        }

        echo "</table>";
        ?>
        

        <style>
        #usersTable {
            font-family: 'Bebas Neue', sans-serif;
            border-collapse: collapse;
            width: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 45px;
            margin-bottom: 50px;
        }

        #usersTable h1 {
            text-align: center;
            margin-top: 25px;
        }

        #usersTable td, #usersTable th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #usersTable tr {
            background-color: #7b5aae;
        }


        #usersTable th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #7b5aae;
            color: white;
        }
    </style>
</main>
</body>
</html>