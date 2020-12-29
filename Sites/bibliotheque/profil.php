<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>

    <!-- Importation Bootswatch -->
    <link rel="stylesheet" href="https://bootswatch.com/4/cyborg/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body class="container">
    <?php include 'header.php'; ?>
    <?php
    /* var_dump($_SESSION); */
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

    function age($date)
    {
        return floor((strtotime(date("Y-m-d h:i:s")) - strtotime($date)) / (60 * 60 * 24 * 365.25));
    }
    $age = age($user['birthDate']);
    ?>
    <?php?>
    <div class="card mb-3">
        <h3 class="card-header">Profil de <?php echo $user['prenom'] . " " . $user['nom']; ?></h3>
        <!-- <div class="card-body">
            <h5 class="card-title"></h5>
            <h6 class="card-subtitle text-muted"></h6>
        </div> -->
        
        <img src="upload/<?php echo $avatar ?>" alt="avatar" class="card-img">
        <!-- 
        <svg xmlns="" class="d-block user-select-none" width="100%" height="200" aria-label="Placeholder: Image cap" focusable="false" role="img" preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180" style="font-size:1.125rem;text-anchor:middle">
            <rect width="0%" height="0%" fill="#868e96"></rect>
            <text x="50%" y="50%" fill="#dee2e6" dy=".3em"></text>
        </svg>
        <div class="card-body">
            <p class="card-text"></p>
        </div> -->
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Nom : <?php echo $user['nom'] ?></li>
            <li class="list-group-item">Prenom : <?php echo $user['prenom'] ?></li>
            <li class="list-group-item">Mail : <?php echo $user['mail'] ?></li>
            <li class="list-group-item">Age : <?php echo $age ?></li>
        </ul>
        <div class="card-body">
        
            <a href="#" class="card-link"></a>
        </div>
        <div class="card-footer text-muted">
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>

</html>