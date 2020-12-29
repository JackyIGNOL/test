<?php
session_start();
include 'bdd.php';
try {
    $id = $_SESSION["id"];
    $queryuser = $pdo->query("SELECT * from abonne where id_abonne = $id");
    $user = $queryuser->fetch();
} catch (\Throwable $th) {
    echo $th;
}
$avatar;
if (empty($user['avatar'])) {
    $avatar = "avatardefault.jpg";
} else {
    $avatar = $user['avatar'];
}
?>
<!-- <?php
include 'session.php';
if (!empty($_SESSION['email'])) {
?>
  <li class="nav-item">
    <a class="nav-link" href="inscription.php">Bonjour abonné!</a>
  </li>

<?php
}
?> -->