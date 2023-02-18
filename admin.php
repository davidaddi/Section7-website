<?php 
require_once('inc/headHTML.php');
require_once('lib/testadmin.php');
include_once('inc/nav.php');

$isConnected = isset($_SESSION["user"]);

if (!$isAdmin) {
    header('Location: index.php');
    exit();
}

if(!$isConnected) {
    header('Location: index.php');
    exit();
}


?>

<main>
<button class="btn-orange"><a href="addMission.php">Ajouter une nouvelle mission</a></button>
<div class="allSubs">
    <h1 class="newSectionH1">Toutes les soumissions</h1>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="sortSubs">
        <label>
            <input type="radio" name="status" value="A">
            Afficher les soumissions de la missions actives
        </label>
        <label>
            <input type="radio" name="status" value="all" checked>
            Afficher toutes les soumissions
        </label>
        <input type="submit" value="Afficher les soumissions">
    </form>

    <table id="usersTable">
        <tr>
            <th>Mission</th>
            <th>Repo Github</th>
        </tr>

    <?php
        $sql = "SELECT * FROM missions_submissions";
        $stmt = $db->query($sql);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $status = $_POST['status'];

        if ($status == 'A') {
            $sql = "SELECT * FROM missions_submissions
                    INNER JOIN missions_desc ON missions_submissions.nomMission = missions_desc.nomMission
                    WHERE missions_desc.statut = 'A'";
            $stmt = $db->query($sql);
            }
        }

        while ($submission = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '
                <tr>
                    <td>'.$submission['nomMission'].'</td>
                    <td><a href='.$submission['lien_repo_github'].'>'.$submission['lien_repo_github'].'</a></td>
                </tr>';
            };
            echo'</table>';
        ?>

</div>

<div class="allMembers" >
    <h1 class="newSectionH1">Tous les membres</h1>
    <p style="text-align: center; color: #fff">(Par default tous les membres sont affichés)</p>
    <form method="get" class="searchUsers">
        <label for="username" style="color: #fff">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
        <input type="submit" value="Rechercher">
    </form>
    <?php
    if(isset($_GET['username']) && !empty($_GET['username'])) {
        $username = $_GET['username'];
        $stmt = $db->prepare("SELECT * FROM users WHERE username LIKE CONCAT('%', :username, '%')");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $users = $stmt->fetchAll();
    } else {
        $stmt = $db->prepare('SELECT * FROM users');
        $stmt->execute();
        $users = $stmt->fetchAll();
    }
    ?>
    <table id="usersTable">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Github</th>
            <th>Discord</th>
            <th> </th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['role'] ?></td>
                <td><?= $user['github'] ?></td>
                <td><?= $user['discord'] ?></td>
                <td>
                    <input type="hidden" name="action">
                    <button class="btn-danger" onclick="return confirm('Voulez vous vraiment bannir le compte ?');">
                        <a href="admindelete.php?id=<?= $user['id'] ?>&email=<?= $user['email'] ?>&username=<?= $user['username'] ?>"
                           class="delete" style="color: #fff">Bannir le compte</a></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<style>
    .btn-orange {
        background: #ff5c00;
        color: white;
        font-family: 'Bebas Neue';
        padding: 12px 20px;
        border: none;
        cursor: pointer;
        font-size: 20px;
        display: flex;
        align-items: center;
        margin: auto;
    }
</style>


</main>