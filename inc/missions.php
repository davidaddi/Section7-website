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
        <div class="mission urgent" style="max-width: 1000px;">
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
        $stmt = $db->prepare('SELECT * FROM missions_desc WHERE statut="F" LIMIT 3');
        $stmt->execute();                       
        $count = $stmt->rowCount();
        $oldMissions = $stmt->fetchAll();
        

        if ($count === 1) {
            foreach ($oldMissions as $oldMission) {
                echo '<div class="mission" style="max-width: 470px; margin: 0 auto; margin-top: 35px;">
                <h3 class="mission-title">Mission '. $oldMission['idMission'] .' - '. $oldMission['nomMission'] .'</h3>
                <h3>Rang '. $oldMission["rangMission"] .'</h3>
                <h3 class="recomp">Objectif : '.$oldMission["objectifMission"].'</h3>
                <h3 class="recomp">Récompense : <span>+'.$oldMission["recompense"].' DC</span></h3>
                <details>
                <summary>Voir l\'énoncé de la mission</summary>
                <p>'.$oldMission["enonce"].'</p>
                </details>
                </div>';
                echo '</div>';
            }
        }

        else if ($count === 2) {
            echo '<div style="max-width: 940px; margin: 0 auto; display: flex; justify-content: space-between; ">';
            foreach ($oldMissions as $oldMission) {
                echo '<div class="mission" style="width: 47%; text-align: center; margin-right: 25px; margin-top: 35px;">
                <h3 class="mission-title">Mission '. $oldMission['idMission'] .' - '. $oldMission['nomMission'] .'</h3>
                <h3>Rang '. $oldMission["rangMission"] .'</h3>
                <h3 class="recomp">Objectif : '.$oldMission["objectifMission"].'</h3>
                <h3 class="recomp">Récompense : <span>+'.$oldMission["recompense"].' DC</span></h3>
                <details>
                <summary>Voir l\'énoncé de la mission</summary>
                <p>'.$oldMission["enonce"].'</p>
                </details>
                </div>';
            }
            echo '</div>';
        }

        else if ($count === 3) {
            echo '<div style="max-width: 940px; margin: 0 auto; margin-top: 35px; display: flex; justify-content: space-between;">';
            foreach ($oldMissions as $oldMission) {
                echo '<div class="mission" style="width: 30%; text-align: center;margin-left: 30px;" >
                <h3 class="mission-title">Mission '. $oldMission['idMission'] .' - '. $oldMission['nomMission'] .'</h3>
                <h3>Rang '. $oldMission["rangMission"] .'</h3>
                <h3 class="recomp">Objectif : '.$oldMission["objectifMission"].'</h3>
                <h3 class="recomp">Récompense : <span>+'.$oldMission["recompense"].' DC</span></h3>
                <details>
                <summary>Voir l\'énoncé de la mission</summary>
                <p>'.$oldMission["enonce"].'</p>
                </details>
                </div>';
            }
            echo '</div>';
        }
    ?>
    </div>
</section> 