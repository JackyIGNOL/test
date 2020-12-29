<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Importation Bootswatch -->
    <link rel="stylesheet" href="https://bootswatch.com/4/cyborg/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <title>Deconnexion</title>
</head>

<body class ="container">
    <?php include 'header.php'; 
    include 'bdd.php';
    try {
        $id = $_SESSION["id"];
        $queryuser = $pdo->query("SELECT * from abonne where id_abonne = $id");
        $user = $queryuser->fetch();
    } catch (\Throwable $th) {
        echo $th;
    }
    if (!empty($_GET['action']) && $_GET['action'] === "deconnecte") {
        session_unset();
        header('Location: index0.php');
    }
    ?>
    <div class="card mb-3">
        <h3 class="card-header">Profil de <?php echo $user['prenom'] . " " . $user['nom']; ?></h3>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Nom : <?php echo $user['nom'] ?></li>
            <li class="list-group-item">Prenom : <?php echo $user['prenom'] ?></li>
            <li class="list-group-item">Mail : <?php echo $user['mail'] ?></li>
        </ul>
        <div class="card-body">
            <a href="#" class="card-link"></a>
        </div>
        <div class="card-footer text-muted">
        </div>
        <a href="deconnexion.php?action=deconnecte"><button class="btn btn-danger w-100">Deconnexion</button> </a>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>

</html>