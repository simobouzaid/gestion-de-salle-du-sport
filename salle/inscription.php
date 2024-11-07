<?php
if (isset($_POST['connexion'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];




    if (!empty($name) && !empty($password)) {
        require_once 'class.php';
        require_once 'database/database.php';

        $np = new cm($pdo);
        $np->nsp($name, $password);


        header('location:connexion.php');
    } else { ?>
        <div class="alert alert-danger" role="alert">
            votre nom ou votre mot de passe est incorrecte

        </div><?php }
        } ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>inscription</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        height: 100vh;
    }
</style>

<body>

    <h1 align="center">inscription</h1>
    <form method="post" align="center">
        <input type="text" class="form-label" name="name" placeholder="name"><br>
        <input type="password" name="password" placeholder="password"><br><br>
        <input type="submit" value="inscription" name="connexion" class="btn btn-success "><br><br>
        <a href="connexion.php" class="btn btn-primary ">connexion </a>
    </form>
    <br>


</body>

</html>