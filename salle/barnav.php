<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$responsable_id = $_SESSION['rsp']['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    
</head>
<body>
<ul class="nav nav-pills nav-justified">
  <li class="nav-item">
    <a class="nav-link" aria-current="page" href="index.php?id=<?= $responsable_id ?>">liste des utulisateur</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="admin.php">ajouter des utulisateur</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="statique.php">statique</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="connexion.php">deconnexion</a>
  </li>
  
</ul>
</body>
</html>