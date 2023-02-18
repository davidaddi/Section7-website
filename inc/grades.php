<?php 
require('lib/db.php');
$stmt = $db->prepare('SELECT * FROM grades');
$stmt->execute();

$grades = $stmt->fetchAll();

?>

<section id="grades">
    <div class="gradesDesc">
        <h1 class="newSectionH1">Les Grades</h1>
        <!-- <p>Le système de grade dans la Section 7 est basé sur la Dev Cred. Il existe différents rangs allant du Rang A au Rang S, chacun associé à un certain nombre de points Dev Cred nécessaires pour le atteindre.</p></div>
        -->
    <div class="grades">
    <?php 
            foreach ($grades as $grade) {
                echo '<div class="grade"><img src="src/media/'. $grade['image'] .'.png"><h2>'. $grade['nom'] .'</h2><p>'. $grade['dc'] .'DC</p></div>';
            }
        ?>
    </div>

</section> 