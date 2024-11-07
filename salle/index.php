<?php
session_start();
if (!isset($_SESSION['rsp'])) {
    header('location: connexion.php');
    exit;
}

require_once 'database/database.php';
include 'barnav.php';
require_once 'class.php';

$cm = new cm($pdo);

if (isset($_POST['complete'])) {
    $clientId = $_POST['client_id'];
    $date = new DateTime(date('Y-m-d'));
    $date1 = new DateTime(date('Y-m-d'));

    
        $date_pm1 = $date1->format('Y-m-d');
    $date_inscp1 = $date->format('Y-m-d');
    $cm->update($date_inscp1, $date_pm1, $clientId);

    echo "<div class='alert alert-success' role='alert'>mise à jour</div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List des utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <h5>les nombres des clients inscrits:
        <?php
        $i = $cm->fullstatique($_SESSION['rsp']['id']);
        echo $i;
        ?>
    </h5>
</head>
<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Prenom</th>
                <th scope="col">Nom</th>
                <th scope="col">Prix</th>
                <th scope="col">Date de création</th>
                <th scope="col">Date de paiement</th>
                <th>Modifier | Supprimer</th>
                <th>Procédures</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $responsable_id = $_SESSION['rsp']['id'];
            $results = $cm->fullselect($responsable_id);

            foreach ($results as $client) {
            ?>
                <tr>
                    <th scope="row"><?php echo $client['id']; ?></th>
                    <td><?php echo $client['nom_cl']; ?></td>
                    <td><?php echo $client['prenom_cl']; ?></td>
                    <td><?php echo $client['prix']; ?>dh</td>
                    <td><?php echo $client['date_inscp']; ?></td>
                    <td><?php echo $client['date_pm']; ?></td>
                    <td>
                        <a href="modifier.php?id=<?php echo $client['id']; ?>" class="btn btn-primary">Modifier</a>
                        <a href="suprimmer.php?id=<?php echo $client['id']; ?>" class="btn btn-danger">Supprimer</a>
                    </td>
                    <td>
                        <?php
                        $dates = new DateTime($client['date_pm']);
                        $date = new DateTime(date('Y-m-d'));
                        $date1 = new DateTime($client['date_inscp']);
                        $diff = $dates->diff($date);

                        if ($dates >= $date) {
                            echo "jours restants: " . $diff->days . " jours";
                        } else {
                            echo "retard de paiement: " . $diff->days . " jours";
                        }

                        if ($date >= $dates) {
                        ?>
                            <form action="" method="post">
                                <input type="hidden" name="client_id" value="<?php echo $client['id']; ?>">
                                <input type="submit" class="btn btn-success" value="complete" name="complete">
                            </form>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <div class="text-center">
        <form action="" method="get">
            <input type="submit" name="tout" class="btn btn-danger" value="supprimer toutes les données">
        </form>
    </div>

    <?php
    if (isset($_GET['tout'])) {
        $tout = new cm($pdo);
        $tout->toute($responsable_id);
    }
    ?>
</body>
</html>
