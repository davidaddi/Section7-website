<?php

include_once('inc/headHTML.php');
require("./lib/db.php"); 
require_once('lib/testadmin.php');
include_once('inc/nav.php');

$isConnected = isset($_SESSION["user"]);

if (!$isAdmin) {
    header('Location: index.php');
    exit();
}

if(!empty($_POST)) {
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    extract($post);

    $errors = [];

    if (empty($nomMission)) {
        $err = 'Veuillez entrer un nom pour la mission.';
        $errors[] = $err;
    }

    $req = $db->prepare("SELECT * FROM missions_desc WHERE nomMission='$nomMission'");
    $req->execute();

    if($req->rowCount() > 0){
        $err = 'Ce nom de mission est déjà utilisé';
        $errors[] = $err;
    }

    if(empty($objectifMission)) {
        $err = 'Veuillez objectif pour la mission.';
        $errors[] = $err;
    }

    if (!isset($rangMission) || !in_array($rangMission, ['A', 'B', 'C', 'S'])) {
        $err = 'Entrez un rang pour la mission.';
        $errors[] = $err;
    }

    if (!isset($recompMission) || $recompMission <= 0) {
        $err = 'Entrez une récompense pour la mission.';
        $errors[] = $err;
    }

    if(empty($finMission)) {
        $err = 'Entrez une date de fin pour la mission.';
        $errors[] = $err;
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($errors)) {
        $credentials = $_POST;

        $updateStmt = $db->prepare('UPDATE missions_desc SET statut = "F" WHERE statut = "A"');
        $updateStmt->execute();

        $stmt = $db->prepare('INSERT INTO missions_desc (nomMission, rangMission, objectifMission, recompense, enonce, deadline, statut) 
        VALUES (:nomMission, :rangMission, :objectifMission, :recompense, :enonce, :deadline, "A")');

        $stmt->execute([
            ":nomMission"=>$credentials['nomMission'],
            ":rangMission"=>$credentials['rangMission'],
            ":objectifMission"=>$credentials['objectifMission'],
            ":recompense"=>$credentials['recompMission'],
            ":enonce"=>$credentials['enonceMission'],
            ":deadline"=>$credentials['finMission']
        ]);
        $success = 'La mission est bien enregistrée, elle devient la mission en cours.';
    }
}

?>

<?php
if(!empty($success)):?>
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
    <h2>Ajouter une mission</h2>
    <div class="form-group">
        <label for="username">Nom de la mission :</label>
        <div class="input-group">
        <input type="text" name="nomMission" placeholder="Nom de la mission" value="<?= $nomMission ?? ''; ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="github">Objectif de la Mission</label>
        <div class="input-group">
            <input type="text" name="objectifMission" placeholder="Objectif de la mission" value="<?= $objectifMission ?? ''; ?>">
        </div>
    </div>

    <div class="form-group">
    <label for="discord">Rang de la Mission</label>
    <div class="input-group">
        <select name="rangMission" id="rangSelect">
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="c">C</option>
            <option value="S">S</option>
        </select>
    </div>
    </div>

    <div class="form-group">
        <label for="enconceMission">Énoncé de la mission</label>
        <div class="input-group">
            <textarea name="enonceMission" rows="5" cols="60" placeholder="Si l'objectif résume assez bien il n'est pas obligatoire de mettre un énoncé" value="<?= $enonceMission ?? ''; ?>"></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="github">Récompense pour la Mission</label>
        <div class="input-group">
            <input name="recompMission" type="number" min="0" step="1" value="<?= $recompMission ?? ''; ?>"/>
        </div>
    </div>

    <div class="form-group">
        <label for="meeting-time">Date Limite :</label>
            <input type="datetime-local" name="finMission" value="2023-02-16T19:30">
        </div>
    </div>
    <button type="submit">ENVOYER</button>
</form>
