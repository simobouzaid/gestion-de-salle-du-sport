<?php
session_start();
if(!isset($_SESSION['rsp'])){
    header('location: connexion.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Modifier</title>
    <style>
        .form-container {
            margin: 50px auto;
            max-width: 500px;
        }
    </style>
    <script>
        function validateForm() {
            const nom = document.forms["clientForm"]["nom_cl"].value;
            const prenom = document.forms["clientForm"]["prenom_cl"].value;
            const prix = document.forms["clientForm"]["prix"].value;
            const date = document.forms["clientForm"]["date_inscp"].value;
            
            if (nom == "" || prenom == "" || prix == "" || date == "") {
                alert("Tous les champs sont obligatoires!");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<?php include 'barnav.php'; ?>

<h1 align="center">Modifier</h1>

<?php
require_once 'database/database.php';
$id = $_GET['id'];
$sqlstate = $pdo->prepare('SELECT * FROM client WHERE id = ?');
$sqlstate->execute([$id]);
$client = $sqlstate->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['modifier'])) {
    $id_cl = $_POST['id'];
    $nom_cl = $_POST['nom_cl'];
    $prenom_cl = $_POST['prenom_cl'];
    $prix = $_POST['prix'];
    $date_inscp = $_POST['date_inscp'];
    $dates = new DateTime($date_inscp);
    $date_pm = $dates->modify('+30 days')->format('Y-m-d');

    if (!empty($id_cl) && !empty($nom_cl) && !empty($prenom_cl) && !empty($prix)) {
        $sqlstate = $pdo->prepare('UPDATE client SET nom_cl = ?, prenom_cl = ?, prix = ?, date_inscp = ?, date_pm = ? WHERE id = ?');
        $sqlstate->execute([$nom_cl, $prenom_cl, $prix, $date_inscp, $date_pm, $id_cl]);
        header('location: index.php');
    }
}
?>

<div class="form-container text-center">
    <form name="clientForm" method="post" onsubmit="return validateForm()">
        <input type="hidden" name="id" value="<?php echo $client['id'] ?>"><br><br>
        <input type="text" name="nom_cl" placeholder="Nom" value="<?php echo $client['nom_cl'] ?>"><br><br>
        <input type="text" name="prenom_cl" placeholder="Prenom" value="<?php echo $client['prenom_cl'] ?>"><br><br>
        <input type="number" name="prix" placeholder="Prix" value="<?php echo $client['prix'] ?>"><br><br>
        <input type="date" name="date_inscp" value="<?php echo $client['date_inscp'] ?>"><br><br>
        <input type="submit" class="btn btn-primary" value="Modifier" name="modifier">
    </form>
</div>
</body>
</html>
