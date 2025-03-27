<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Affichage Graphique des Données Météorologiques</title>
    <link rel="stylesheet" href="stylegestionstation.css" />
</head>
<body>

<h1>Affichage Graphique des Données Météorologiques</h1>

<?php
// a. Enregistrer les variables transmises par la méthode GET
$ValId_station = isset($_GET['IdStationA']) ? $_GET['IdStationA'] : '';
$ValNumJour = isset($_GET['NumJourA']) ? $_GET['NumJourA'] : '';

// Vérifier si les deux paramètres sont présents
if ($ValId_station && $ValNumJour) {
    // Connexion à la base de données
    try {
        $Bdd = new PDO('mysql:host=localhost;dbname=gestion_station', 'root', '');
        $Bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        die('Erreur de connexion : ' . $e->getMessage());
    }

    // b. Préparer la requête SELECT pour récupérer les données de la station au jour spécifié
    $requete = $Bdd->prepare('SELECT m.*, s.nom as nom_station, m.vitesse_vent, m.direction_vent 
                            FROM mesures m 
                            JOIN stations s ON m.id_station = s.id 
                            WHERE m.id_station = :id_station AND m.date = :date');
    $requete->execute(array(
        'id_station' => $ValId_station,
        'date' => $ValNumJour
    ));

    // c. Récupérer les données
    $donnees = $requete->fetch();

    if ($donnees) {
        // d. Affichage des données dans le tableau
        echo '<table>';
        echo '<tr><th>Nom de la station</th><th>Température</th><th>Précipitation</th><th>Vitesse du Vent</th><th>Direction du Vent</th></tr>';
        echo '<tr>';
        
        // Afficher le nom de la station (au lieu de l'ID)
        echo '<td>' . htmlspecialchars($donnees['nom_station'] ?? $donnees['id_station']) . '</td>';
        
        // Afficher la température avec l'unité
        echo '<td>' . htmlspecialchars($donnees['temperature']) . '°C</td>';
        
        // Afficher la précipitation avec l'unité
        echo '<td>' . htmlspecialchars($donnees['precipitation'] ?? $donnees['ensoleillement']) . ' mm</td>';
        
        // Afficher la vitesse du vent avec l'unité
        echo '<td>' . htmlspecialchars($donnees['vitesse_vent'] ?? 10) . ' km/h</td>';
        
        // Afficher la direction du vent avec l'unité
        echo '<td>' . htmlspecialchars($donnees['direction_vent'] ?? 0) . '°</td>';
        
        echo '</tr>';

        // 2. Interprétation des données avec des images

        // a. Température
        $tempImage = '';
        if ($donnees['temperature'] < 10) {
            $tempImage = 'images/temperature_froid.png';  // Température inférieure à 10°C
        } elseif ($donnees['temperature'] >= 10 && $donnees['temperature'] <= 32) {
            $tempImage = 'images/temperature_moyen.png'; // Température entre 10°C et 32°C
        } else {
            $tempImage = 'images/temperature_chaud.png';  // Température supérieure à 32°C
        }

        // b. Précipitation (supposons que ensoleillement contient les données de précipitation)
        $precipImage = '';
        $precipitation = $donnees['precipitation'] ?? $donnees['ensoleillement'];
        if ($precipitation == 0) {
            $precipImage = 'images/soleil.png'; // Pas de précipitation
        } elseif ($precipitation >= 1 && $precipitation <= 4) {
            $precipImage = 'images/pluie_faible.png'; // Précipitation entre 1 et 4 mm
        } elseif ($precipitation > 4 && $precipitation <= 8) {
            $precipImage = 'images/pluie_moyen.png'; // Précipitation entre 4 et 8 mm
        } else {
            $precipImage = 'images/pluie_forte.png'; // Précipitation supérieure à 8 mm
        }

        // c. Vitesse du vent
        $windImage = '';
        $windSpeed = $donnees['vitesse_vent'] ?? 10; // Utiliser la vitesse du vent réelle si disponible
        if ($windSpeed < 2) {
            $windImage = 'images/vent_faible.png'; // Vent faible
        } elseif ($windSpeed >= 2 && $windSpeed <= 13) {
            $windImage = 'images/vent_moyen.png'; // Vent modéré
        } else {
            $windImage = 'images/vent_fort.png'; // Vent fort
        }

        // d. Image selon le nom de la station
        $stationImage = '';
        switch ($donnees['id_station']) {
            case 's1':
                $stationImage = 'images/s1.jpg';
                break;
            case 's2':
                $stationImage = 'images/s2.jpg';
                break;
            case 's3':
                $stationImage = 'images/s3.jpg';
                break;
            default:
                $stationImage = 'images/s4.jpg'; // Station inconnue
        }

        // e. Direction du vent
        $directionImage = '';
        $windDirection = $donnees['direction_vent'] ?? 0; // Utiliser la direction du vent réelle si disponible
        
        // Utiliser switch pour déterminer l'image de direction selon la valeur
        if ($windDirection >= 315 || $windDirection < 45) {
            $directionImage = 'images/direction_n.png'; // Nord
        } elseif ($windDirection >= 45 && $windDirection < 135) {
            $directionImage = 'images/direction_e.png'; // Est
        } elseif ($windDirection >= 135 && $windDirection < 225) {
            $directionImage = 'images/direction_s.png'; // Sud
        } elseif ($windDirection >= 225 && $windDirection < 315) {
            $directionImage = 'images/direction_o.png'; // Ouest
        }

        // 3. Afficher les images d'interprétation sous forme de tableau
        echo '<tr>';
        echo '<td colspan="5">Interprétation des données :</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><img src="' . $stationImage . '" alt="Station Image" /></td>';
        echo '<td><img src="' . $tempImage . '" alt="Température Image" /></td>';
        echo '<td><img src="' . $precipImage . '" alt="Précipitation Image" /></td>';
        echo '<td><img src="' . $windImage . '" alt="Vent Image" /></td>';
        echo '<td><img src="' . $directionImage . '" alt="Direction du Vent Image" /></td>';
        echo '</tr>';
        echo '</table>';

        // Fermer la connexion
        $requete->closeCursor();
    } else {
        echo 'Aucune donnée trouvée pour la station ' . htmlspecialchars($ValId_station) . ' au jour ' . htmlspecialchars($ValNumJour) . '.';
    }

    // Fermer la connexion à la base de données
    $Bdd = null;

} else {
    echo 'Veuillez entrer à la fois l\'ID de la station et le numéro du jour.';
}
?>

<form action="gestion_stations.php" method="GET">
    <div>
        <input type="submit" value="RETOUR" />
    </div>
</form>

</body>
</html>