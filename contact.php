<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'bootswatch.php'; ?>
    <title>Contact</title>
</head>

<body class="container">
    <header>
        <?php include 'navbar.php'; ?>
    </header>
    <main><?php
            if (isset($_POST["submit"])) {
                var_dump($_POST);
                $mailexpediteur= "From: ".$_POST['message'];
                mail(
                    "jacky.ignol@gmail.com",
                    $_POST["sujet"],
                    $_POST["message"] . $mailexpediteur
                );
            }
            
            ?>
        <h1 class="text-center">Contact</h1>
        <form action="" method="POST" enctype="multipart/form-data" name="EmailForm">
            <fieldset>
                <div class="form-group">
                    <label for="email">E-mail address</label>
                    <input name="mail" type="email" class="form-control" id="Email" aria-describedby="emailHelp" placeholder="Entrer votre e-mail">
                </div>
                <!-- 
                    <div class="form-group">
                        <label for="sujet">Sujet de L' E-mail</label>
                        <input type="text" class="form-control" id="sujet" aria-describedby="SubjectHelp" placeholder="Le sujet de votre message">
                    </div> -->
                <div class="form-group">
                    <label class="col-form-label" for="inputDefault">Sujet de L' E-mail</label>
                    <input name="sujet" type="text" class="form-control" placeholder="Le sujet de votre message" id="sujet">
                </div>
                <div class="form-group">
                    <label for="exampleTextarea">Le contenu de votre message</label>
                    <textarea name="message" class="form-control" id="message" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </fieldset>
        </form>
    </main>
    <footer></footer>

</body>

</html>