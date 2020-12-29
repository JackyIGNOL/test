<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription</title>

    <!-- Importation Bootswatch -->
    <link rel="stylesheet" href="https://bootswatch.com/4/cyborg/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body class="container">
    <?php?>
    <?php
    include 'bdd.php';
    include 'header.php';

    function valideDate($date, $format = 'd/m/Y')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    if (isset($_POST['envoyer'])) {
        try {
            $mail = $_POST['email'];

            $queryuser = $pdo->query("SELECT * from abonne where mail = '$mail'");
            $user = $queryuser->fetchAll(PDO::FETCH_ASSOC);
            //code...
        } catch (\Throwable $th) {
            echo $th;
        }
        if (empty($_POST['nom'])) { //Verifier les champs vide
            echo "<p>le nom doit être obligatoire.</p>";
        } elseif (empty($_POST['prenom'])) {
            echo "<p>le prenom doit être obligatoire.</p>";
        } elseif (empty($_POST['email'])) {
            echo "<p>le prenom doit être obligatoire.</p>";
        } elseif (empty($_POST['password'])) {
            echo "<p>le formulaire nom doit être rempli.</p>";
        } elseif (empty($_POST['dateNaissance'])) {
            echo "<p>le formulaire nom doit être rempli.</p>";
        } elseif (strlen($_POST['nom']) < 4) { //taille nom >4
            echo "<p>le nom doit faire plus de 4 charactère.</p>";
        } elseif (!is_string($_POST['nom'])) { //nom type string
            echo "<p>le nom doit etre un string.</p>";
        } elseif (!is_string($_POST['prenom'])) { //prenom type string
            echo "<p>le prenom doit etre un string.</p>";
        } elseif (valideDate($_POST['dateNaissance'])) { //mail preg match
            echo "<p>le date n'est pas valide</p>";
        } elseif (!preg_match(" /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ", $_POST['email'])) {
            echo "<p>Le format du mail est invalide.</p>";
        } elseif (strlen($_POST['password']) < 0) { //mdp >4
            echo "<p>le mot de passe doit faire plus de 4 charactère. </p>";
        } elseif (!empty($user)) {
            echo "<br><br>L'email est déjà utlisé dans un compte";
        } else {
            try {
                // ENREGISTREMENT DE L'IMAGE DANS UPLOAD
                $fichierNom = $_FILES['avatar']['name'];
                $fichierType = $_FILES['avatar']['type'];
                $fichierTemporaire = $_FILES['avatar']['tmp_name'];
                $fichierTaille = $_FILES['avatar']['size'];
                $fichierErreur = $_FILES['avatar']['error'];

                $tab = explode(".", $fichierNom);
                $extention = strtolower(end($tab));
                $tabextension = array("jpg", "png", "svg", "jpeg");
                if (!empty($fichierNom)) {
                    if (empty($fichierErreur)) {
                        if (in_array($extention, $tabextension)) {
                            if ($fichierTaille < 1000000) {
                                $fileNameNew = uniqid("avatar", true) . "." . $extention;
                                $destination = "upload/" . $fileNameNew;
                                move_uploaded_file($fichierTemporaire, $destination);
                                echo $fichierNom . " : " . $fileNameNew . " téléchargé avec succes";
                            } else {
                                echo "Le fichers doit avoir une taille inférieur à 1mb";
                            }
                        } else {
                            echo "Le fichiers doit être un jpg, jpeg, png ou svg.";
                        }
                    } else {
                        echo "Le fichers contient des erreurs";
                    }
                }

                // INTEGRATION A LA BASE DE DONNEE
                // eviter les failles XSS avec htmlentities()  htmlentities($_POST['nom'])

                $prenom = htmlentities($_POST['prenom']); //faille XSS htmlentities() 
                $nom = htmlentities($_POST['nom']);
                $mail = htmlentities($_POST['email']);
                $birthDate = htmlentities($_POST['dateNaissance']);
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //insertion mdp hash
                $queryinsert = $pdo->prepare("INSERT INTO abonne(prenom,nom,mail,birthDate,password) VALUES(:prenom,:nom,:mail,:birthDate,:password)");
                $queryinsert->execute([
                    "prenom" => $prenom,
                    "nom" => $nom,
                    "mail" => $mail,
                    "birthDate" => $birthDate,
                    "password" => $password,
                ]);
                if (empty($fichierErreur)) {
                    $avatar = $fileNameNew;
                    $queryinsert = $pdo->prepare("UPDATE abonne SET avatar = :avatar WHERE mail = :mail)");
                    $queryinsert->execute([
                        "avatar" => $avatar,
                    ]);
                }
                $success = "L'insertion est parfaite";
                /* var_dump($_POST); */
                /*header('Location: index0.php'); */
                /* var_dump($queryinsert); */
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
    ?>
    <br>
    <h1 class="text-center">Formulaire d' Inscription</h1>
    <form action="" method="post" class="inscription" enctype="multipart/form-data">
        <fieldset>
            <div class="form-group">
                <label for="">Nom</label>
                <input type="text" class="form-control" id="nom" placeholder="Votre nom" name="nom">
            </div>
            <div class="form-group">
                <label for="">Prenom</label>
                <input type="text" class="form-control" id="prenom" placeholder="Votre prenom" name="prenom">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Votre Email" name="email">
            </div>
            <div class="form-group">
                <label for="">Mot de passs</label>
                <input type="password" class="form-control" id="password" placeholder="Votre mot de Passe" name="password">
            </div>
            <div class="form-group">
                <label class="col-form-label" for="dateNaissancet">Date de Naissance</label>
                <input type="date" class="form-control" id="dateNaissance" name="dateNaissance">
            </div>
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <label class="custom-file-label text-dark" for="inputGroupFile02">Photo de profile</label>
                        <input type="file" class="custom-file-input" id="inputGroupFile02" name="avatar">
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Télécharger</span>
                    </div>
                </div>
            </div>
            </div><br>
            <button type="submit" class="btn btn-primary w-100" name="envoyer">Inscription</button>
        </fieldset>
    </form>
    <a href="connexion.php"><button type="button" class="btn btn-info w-100">Si vous avez déjà un compte connectez vous ici</button></a>
    <?php
    include 'footer.php';
    ?>
</body>

</html>