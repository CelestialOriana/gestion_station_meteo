<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Effacer des données</title>
    <link rel="stylesheet" href="stylegestionstation.css" />
</head>
<body>
    <h1>Effacer des données de la station</h1>

    <?php
    try {
        // Connexion à la base de données
        $Bdd = new PDO('mysql:host=localhost;dbname=gestion_station', 'root', '');
        // Définir le mode d'erreur des requêtes PDO
        $Bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        die('Erreur de connexion : ' . $e->getMessage());
    }

    // Récupérer les valeurs envoyées via GET
    $ValId_station = isset($_GET['IdStationE']) ? $_GET['IdStationE'] : '';
    $ValNumJour = isset($_GET['NumJourE']) ? $_GET['NumJourE'] : '';

    // Vérifier si les valeurs sont fournies
    if ($ValId_station && $ValNumJour) {
        try {
            // Préparer la requête DELETE
            $requete = $Bdd->prepare('DELETE FROM mesures WHERE id_station = :id_station AND date = :num_jour');
            
            // Exécuter la requête avec les valeurs récupérées
            $requete->execute(array(
                'id_station' => $ValId_station,
                'num_jour' => $ValNumJour
            ));

            // Vérifier si des lignes ont été supprimées
            if ($requete->rowCount() > 0) {
                echo "Les données de la station avec l'ID $ValId_station pour le jour $ValNumJour ont été supprimées avec succès!";
            } else {
                echo "Aucune donnée trouvée avec l'ID de la station $ValId_station et le jour $ValNumJour.";
            }
        } catch (Exception $e) {
            echo "Erreur lors de la suppression des données : " . $e->getMessage();
        }
    } else {
        echo "Veuillez spécifier l'ID de la station et le jour à supprimer.";
    }

    // Fermer la connexion
    $Bdd = null;
    ?>

    <form action="gestion_stations.php" method="GET">
        <div>
            <input type="submit" value="RETOUR" />
        </div>
    </form>
</body>
</html>
