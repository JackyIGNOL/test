<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <a class="navbar-brand" href="index0.php">Notre Bibliotheque</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="livre.php">Nos Livres</a>
        </li>
        <?php session_start();
        if (isset($_SESSION['id'])) {
        ?>
          <li class="nav-item">
            <a class="nav-link" href="profil.php">Profil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="deconnexion.php">Deconnexion</a>
          </li>
        <?php
        } else {
        ?>
          <li class="nav-item">
            <a class="nav-link" href="inscription.php">Inscription</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="connexion.php">Connexion</a>
          </li>
        <?php
        }
        ?>
        <li class="nav-item">
          <a class="nav-link" href="../../projets.php">Revenir aux projets</a>
        </li>
      </ul>
    </div>
  </nav>
</header>