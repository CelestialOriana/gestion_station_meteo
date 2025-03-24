<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Inserer données</title>
    <link rel="stylesheet" href="stylegestionstation.css" />
    <?php
    try {
        // Connexion à la base de données
        $Bdd = new PDO('mysql:host=localhost;dbname=gestion_station', 'root', '');
    } catch (Exception $e) {
        die('Erreur de connexion : ' . $e->getMessage());
    }

    // Récupérer les paramètres du formulaire via la méthode GET
    $ValId_station = isset($_GET['IdStationI']) ? $_GET['IdStationI'] : '';
    $ValJour = isset($_GET['NumJourI']) ? $_GET['NumJourI'] : '';
    $ValTemp = isset($_GET['ValeurTI']) ? $_GET['ValeurTI'] : '';
    $ValEns = isset($_GET['ValeurEI']) ? $_GET['ValeurEI'] : '';

    // Préparer la requête INSERT INTO
    $requete = $Bdd->prepare('INSERT INTO mesures (temperature, ensoleillement, date, id_station) VALUES (:f1, :f2, :f3, :f4)');

    // Exécuter la requête avec les valeurs récupérées
    $requete->execute(array(
        'f1' => $ValTemp,
        'f2' => $ValEns,
        'f3' => $ValJour,
        'f4' => $ValId_station
    ));

        echo "Données insérées avec succès!";
    ?>
</head>
<body>
    <h1>INTERFACE DE GESTION DES STATIONS METEOROLOGIQUES</h1>

    <form action="gestion_stations.php" method="GET">
        <div>
            <input type="submit" value="RETOUR" />
        </div>
    </form>
</body>
</html>
