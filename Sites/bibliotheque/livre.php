<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/cyborg/bootstrap.min.css">
    <title>Tableau</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        a {
            color: white;
        }

        h1 {
            text-align: center;
        }

        th {
            border: blue solid 1px;
            font-size: 1.5rem;
            text-align: center;
        }

        td {
            /* border: red solid 1px; */
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: grey;
        }

        /*  */
    </style>
</head>

<body class="container">
    <?php
    include 'bdd.php';
    include 'header.php';
    try {
        $queryStatement = $pdo->query("SELECT* from livre");
        /* var_dump($queryStatement); */
        $noslivre = $queryStatement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    ?>
    <div class="container">
        <h1>Nos Livre</h1>
        <table>
            <tr>
                <th>Titre</th>
                <th>Auteur</th>
            </tr>
            <?php
            foreach ($noslivre as $petittable) {
            ?>
                <tr>
                    <td><?php echo $petittable['titre'] ?></td>
                    <td><?php echo $petittable['auteur'] ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>

</html>