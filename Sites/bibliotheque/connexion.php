<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>

    <!-- Importation Bootswatch -->
    <link rel="stylesheet" href="https://bootswatch.com/4/cyborg/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body class="container">
    <?php
    include 'bdd.php';
    include 'header.php';
    /* session_start(); */
    $erreur = null;
    if (isset($_POST['connexion'])) {
        if (empty($_POST['email'])) {
            $erreur = "L'email est vide. ";
            /* echo "<h5 class='text-danger'>L'email est vide<h5>"; */
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $erreur .= "L'email est incorrect. ";
        } else {
            try {
                $mail = htmlentities($_POST['email']);
                $queryuser = $pdo->query("SELECT * from abonne where mail = '$mail'"); 
                $user = $queryuser->fetch();
            } catch (\Throwable $th) {
                echo $th;
            }
            if ($user) {
                        $userPassword = $user['password'];
                        if (password_verify($_POST['password'],$userPassword)) {
                            session_start();
                            $_SESSION["id"] = $user['id_abonne'];
                            $_SESSION['nom'] = $user['nom'];
                            header('Location: profil.php');
                           /*  echo "<h5 class='text-success'>L'email et mot de passe sont correct<h5>"; */
                        } else {
                            echo "<h5 class='text-danger'>Le mot de passe est incorrect<h5>";
                        }
            } else {
                ?>
                <a href="inscription.php"><button type="button" class="btn btn-warning w-100">Si vous n'avez pas encore de compte inscrivez vous ici</button></a>
                <?php
            }
        }
        # code...
        if (empty($_POST['password'])) {
            $erreur .= "Le mot de passe est vide. ";
            /* echo "<h5 class='text-danger'>L'email est vide<h5>"; */
        } elseif (strlen($_POST['password']) < 4) {
            $erreur .= "Le mot de pass doit etre de plus 4 charactere. ";
        }
        /* elseif (condition) {
            # code...
        } */
        /* if (!empty($user)) {
            /* echo "<h5 class='text-danger'>L'email existe dans la base de donné.<h5>"; */
        /* if (!empty($_POST['password'])) {
                $userPassword = $user['password'];
                if (password_verify($_POST['password'], $user['password'])) {
                    echo "<h5 class='text-success'>L'email et mot de passe sont correct<h5>";
                    exit();
                } else {
                    echo "<h5 class='text-danger'>Le mot de passe est incorrect<h5>";
                }
            }else{
                echo "<h5 class='text-danger'>Le champ mot de passe est vide<h5>";
            }
        } else {
            echo "<h5 class='text-danger'>L'email n'existe pas dans la base de donné.<h5>";
        }  */
    }
    ?>
    <h1 class="text-center">Formulaire de Connexion</h1>
    <br>
    <div class="h-100 my-auto">
        <form action="" method="post" class="text-center ">
            <div class="form-group">
                <label class="col-form-label col-form-label-lg" for="inputLarge">
                    <h2>Email</h2>
                </label>
                <input class="form-control form-control-lg" type="text" placeholder="Votre email" id="email" name="email">
            </div>
            <div class="form-group">
                <label class="col-form-label col-form-label-lg" for="inputLarge">
                    <h2>Mot de passe</h2>
                </label>
                <input class="form-control form-control-lg" type="password" placeholder="Votre mot de passe" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary w-100" name="connexion">Connexion</button>
        </form>
    </div>
    <a href="inscription.php"><button type="button" class="btn btn-info w-100">Si vous n'avez pas encore de compte inscrivez vous ici</button></a>
    <?php
    if (!empty($erreur)) {
        echo $erreur;
        # code...
    }
    ?>
    <?php
    include 'footer.php';
    ?>
</body>

</html>