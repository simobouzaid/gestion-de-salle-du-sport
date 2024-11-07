<?php 
if (isset($_POST['connexion'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];

    if (!empty($name) && !empty($password)) {
        require_once 'database/database.php';

        $sqlstate = $pdo->prepare('SELECT * FROM responsable WHERE name=? AND password=?');
        $sqlstate->execute([$name, $password]);

        if ($sqlstate->rowCount() >= 1) {
            session_start();
    
            $user = $sqlstate->fetch(PDO::FETCH_ASSOC); 
            $_SESSION['rsp'] = $user;
            $_SESSION['id'] = $user['id'];
        
            header("Location: index.php?id=" . $_SESSION['id']);
            exit();
        } else {
            ?>
            <div class="alert alert-danger" role="alert">

                le mots de passe ou le nome incorrects
        </div>
            <?php
        }
    } else {
        ?>
        <div class="alert alert-danger" role="alert">
            veuillez entrer le nom et le mots de passe corrects
        </div>
        <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>connexion</title><style>body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            height: 100vh;
        }</style>
    

</head>
<body>
    <h1 align="center">connexion</h1>
    <form method="post" align="center">
        <input type="text" class="form-label" name="name" placeholder="name"><br>
        <input type="password" name="password" placeholder="password"><br><br>
        <input type="submit" value="connexion" name="connexion" class="btn btn-success"><br><br>
        <a href="inscription.php" class="btn btn-primary">inscription</a>
    </form>
</body>
</html>
