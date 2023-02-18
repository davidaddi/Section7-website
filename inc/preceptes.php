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
      <div class="precept" style="display: flex;align-items: center;">
        <div class="preceptLeft">
          <img class="precept-img" style="width: 45px;margin-right: 15px;" src="src/media/'.$precepte['image'].'.png">
        </div>

        <div class="preceptRight">
          <h3 class="precept-title">'.$precepte['precepte'].'</h3>
          <p class="precept-text">'.$precepte['description'].'</p>
        </div>
      </div>
      ';
    }

    ?>
  </div>
</section>