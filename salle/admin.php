<?php
session_start();
if (!isset($_SESSION['rsp'])) {
    header('location: connexion.php');
    exit;
}
require_once 'database/database.php';
include 'barnav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
    </style>
   
</head>
<body>
    <div class="container text-center">
        <h1>Bonjour: <?php echo $_SESSION['rsp']['name']; ?></h1>
    </div>
    
    <?php
    
    if (isset($_POST['ajouter'])) {
        
        $nom_cl = $_POST['nom_cl'];
        $prenom_cl = $_POST['prenom_cl'];
        $prix = $_POST['prix'];
        $date_inscp = $_POST['date_inscp'];
        $date_pm = date('Y-m-d', strtotime($date_inscp . '+30 days'));
        $responsable_id = $_SESSION['rsp']['id'];
        $date = new DateTime();
        $Date = $date->format('y-m-d');
       $sqlstate=$pdo->prepare('SELECT *FROM client where nom_cl=? and prenom_cl=?');
       $sqlstate->execute([$nom_cl,$prenom_cl]);
       if($sqlstate->rowCount() >= 1){?>
        <div class="alert alert-danger" role="alert">
        modifier le nom ou le prenom

            </div>
            <?php
        
       }else{
        if (!empty($nom_cl) && !empty($prenom_cl) && !empty($prix)) {

            $sqlstate = $pdo->prepare('INSERT INTO client (nom_cl, prenom_cl, prix, date_inscp, date_pm, responsable_id, dates)
                                        VALUES (?, ?, ?, ?, ?, ?,?)');
            $sqlstate->execute([$nom_cl, $prenom_cl, $prix, $date_inscp, $date_pm, $responsable_id,$Date]);
            ?>
            <div class="alert alert-success" role="alert">
                Bon ajouté
            </div>
            <?php
           

           



        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                Tous les champs sont obligatoires
            </div>
            <?php }
        
       }
        
        

        
       

    }
    ?>

    <div class="form-container">
        <form name="clientForm" method="post" onsubmit="return validateForm()">
            <div class="mb-3">
                <input type="text" class="form-control" name="nom_cl" placeholder="Prenom">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="prenom_cl" placeholder="Nom">
            </div>
            <div class="mb-3">
                <input type="number" class="form-control" name="prix" placeholder="Prix">
            </div>
            <div class="mb-3">
                <input type="date" class="form-control" name="date_inscp">
            </div>
            <div>
                <input type="submit" class="btn btn-success" value="Ajouter" name="ajouter">
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+lW1SUgWtNPx42yFPkjy9SgIaaFajd4BgMyctv3q5cMWD5bN1HA+HRtWfX98u" crossorigin="anonymous"></script>
</body>
</html>
