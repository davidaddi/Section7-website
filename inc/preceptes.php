<section class="precepts-section" id="preceptes">
  <h2 class="newSectionH1">Les préceptes de la Section 7</h2>
  
  <?php 
  $stmt = $db->prepare('SELECT * FROM preceptes');
  $stmt->execute();
  
  $preceptes = $stmt->fetchAll();
  ?>

  <div class="precepts-container">
    <?php 
    
    foreach($preceptes as $precepte) {
      echo '
      <div class="precept">
        <h3 class="precept-title">'.$precepte['precepte'].'</h3>
        <p class="precept-text">'.$precepte['description'].'</p>
      </div>
      ';
    }

    ?>
  </div>
</section>