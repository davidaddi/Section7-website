# Section7-website
Section 7 - Mission 2 : Mettre en place un système efficace pour suivre les missions de la Section 7 et enregistrer les contributions de chaque membre de la communauté.

<h4>Le projet est réalisé en PHP/MySQL native. </h4>
<p><b>Présentation de la base de données `db_section7`</b></p>
<p>
<b>users</b>(<ins>id</ins>, email, username, password, role, github,discord, token)<br>
<b>grades</b>(image, nom, dc)<br>
<b>missions_desc</b>(idMission, <ins>nomMission</ins>, rangMission, objectifMission, recompense, enonce, statut, deadline)<br>
<b>missions_submissions</b>(user, #nomMission, discord, lien_repo_github)<br>
<b>preceptes</b>(precepte, description)<br>
<b>bans</b>(<ins>id</ins>, email, username, password, role, github,discord)<br>
</p>

#### <b>Authentification </b> 
Le site est équipé d'un système d'authentification : inscription, connexion et déconnexion. Il est aussi possible de changer toutes ses informations personnelles (mot de passe (entrain d'être arrangé), pseudo, discord, email) mais aussi de voir l'historique des soumissions de projet.

#### <b>Administrateur</b>
Un système d'administration est également présent, qui passe par la base de données. Après un récent update, il est maintenant possible via le panneau de gestion administrateur ('Coin des administrateurs' dans la barre des tâches), de promouvoir des utilisateurs lambda admins, mais aussi de retirer le rôle admin dans n'importe quel utilisateur. <br>
Notez que si vous retirez le rôle utilisateur a tous les utilisateurs sans exception, il est toujours possible de redesigner un admin dans phpMyAdmin en modifiant la colonne statut de la table <b>users</b>.

#### <b>Missions</b>
Les missions sont sauvegardées dans la base de données dans 2 tables :
<ul>
  <li><b>missions_desc</b>, qui a pour but de répertorier toutes les soumissions de projets</li>
  <li><b>missions_submissions</b>, qui répertorie toutes les informations relatives au missions. La mission en cours est caractérisée par la colonne statut : qui vaut "A" pour la 	mission en cours et "F" pour le reste. A chaque fois que l'on poste une nouvelle 	mission, elle prend automatiquement le statut de mission en cours.
</li>
</ul>
