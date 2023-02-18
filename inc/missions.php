<?php 

require_once('lib/db.php');
$stmt = $db->prepare('SELECT * FROM missions_desc WHERE statut="A"');
$stmt->execute();
$row = $stmt->fetch();

$date_str = $row['deadline'];
$date = new DateTime($date_str);

setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

$date_format = strftime('%e %B %Y à %Hh%M', $date->getTimestamp());


?>

<section class="missions" id="missions">
    <div class="container">
      <h2 class="newSectionH1">Les Missions</h2>
         <!-- <p style="padding: 0px 500px; margin-bottom: 30px;">Le respect que vous recevez dépend de votre grade. Plus votre grade est élevé, plus vous êtes respecté.Vous pouvez augmenter votre grade en accomplissant des missions. À chaque mission accomplie, vous recevrez des points en fonction de sa difficulté, allant du Rang A au Rang S.
        Plus vous accumulez de points, plus votre grade s'élève. Cela vous donne accès à de nouvelles opportunités et à de nouveaux canaux.</p>
         -->
      <div class="mission-wrapper">
        <div class="mission urgent">
          <h3 class="mission-title">Mission en cours - <?php echo($row['nomMission']);?></h3>
          <h3>Rang <?php echo($row['rangMission']);?></h3>
          <h3 class="recomp">Objectif : <?php echo($row['objectifMission']); ?></h3>
          <h3 class="recomp">Récompense : <span>+<?php echo($row['recompense']);?> DC</span></h3>
          <h3 class="recomp">Débriefing de la mission : <span>+<?php echo $date_format;?></span> sur <a href="https://www.tiktok.com/@mauvetech"><u>TikTok</u> et <a href="https://www.twitch.tv/mauvetech"><u>Twitch</u ></a></h3>
          <details>
            <summary>Voir l'énoncé de la mission</summary>
            <p><?php echo($row['enonce']);?></p>
        </details>
        </div>
        
        <?php 
        $stmt = $db->prepare('SELECT * FROM missions_desc WHERE statut="F" LIMIT 6');
        $stmt->execute();                       
        $nbLignes = $stmt->rowCount();
        $oldMissions = $stmt->fetchAll();
        ?> 

        <div class="missions-grid" style="display: grid; grid-template-columns: <?php
                // Définit la largeur des colonnes en fonction du nombre de lignes renvoyées
                switch ($nbLignes) {
                    case 1:
                        echo '1fr';
                        break;
                    case 2:
                        echo '1fr 1fr';
                        break;
                    case 3:
                        echo '1fr 1fr 1fr';
                        break;
                    default:
                        echo '1fr 1fr 1fr 1fr';
                }
            ?>; justify-items: center; gap: 20px;">
            <?php
                foreach($oldMissions as $oldMission) {
                    echo('<div class="mission" style="width: 100%; max-width: 400px; margin-left: calc((100% - ' . $nbLignes . ' * 400px) / ' . $nbLignes * 2 . ');">
                        <h3 class="mission-title">Mission '. $oldMission['idMission'] .' - '. $oldMission['nomMission'] .'</h3>
                        <h3>Rang '. $oldMission["rangMission"] .'</h3>
                        <h3 class="recomp">Objectif : '.$oldMission["objectifMission"].'</h3>
                        <h3 class="recomp">Récompense : <span>+'.$oldMission["recompense"].' DC</span></h3>
                        <details>
                            <summary>Voir l\'énoncé de la mission</summary>
                            <p>'.$oldMission["enonce"].'</p>
                        </details>
                    </div>');
                }
            ?>
          </div>
      </div>
    </div>
</section> 