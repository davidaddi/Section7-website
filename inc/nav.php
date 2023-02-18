<?php require_once('lib/testadmin.php'); ?>
<section id="heroHeader">
    <nav>
        <ul>
            <li><a href="index.php#heroHeader">Acceuil</a></li>
            <li><a href="index.php#grades">Les Grades</a></li>
            <li><a href="index.php#missions">Les Missions</a></li>
            <li><a href="index.php#preceptes">Les Préceptes</a></li>
            <li><a href="index.php#Subs">Soumettre un projet</a></li>

            <?php if(!$isConnected):?>
                <li><a href="connexion.php" class="membres">Se Connecter</a></li>
                <li><a href="inscription.php" class="membres">S'Inscrire</a></li>
            <?php endif;?>   

            <?php if($isConnected): ?>
                <li><a href="membres.php" class="membres">Espace Membres</a></li>
                <li><a href="logout.php" class="membres">Se déconnecter</a></li>
            <?php endif;?>

            <?php if($isAdmin):?>
                <li class="membres"><a href="admin.php">Coin des administrateurs</a></li>
            <?php endif; ?>
        </ul>
        <button class="discordBtn"><i class="fa-brands fa-discord"></i><a href="https://discord.com/invite/Ms78rJFa5d" target="_blank">REJOINDRE LE DISCORD</a></button>
    </nav>  
    