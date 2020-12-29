<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'bootswatch.php'; ?>
    <title>A propos de moi</title>
</head>

<body class="container">
    <header>
        <?php include 'navbar.php'; ?>
    </header>
    <main>
        <h1 class="text-center">A propos de moi</h1>

        <?php
        echo 'Current PHP version: ' . Phpversion();
        ?>
    </main>
    <footer></footer>
</body>

</html>