<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Afficher les données</title>
	<link rel="stylesheet" href="stylegestionstation.css" />
</head>
<body>
	<h1>INTERFACE DE GESTION DES STATIONS METEOROLOGIQUES</h1>

	<p>
		Votre premier bout de code permettant d'afficher des données issues d'une Bdd : Bravo si ça fonctionne en vérifiant dans PhpMyAdmin !<br>

		<?php
		// Connexion à la base de données
		try {
			$Bdd = new PDO('mysql:host=localhost;dbname=gestion_station', 'root', '');
			$Bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (Exception $e) {
			die('Erreur de connexion : ' . $e->getMessage());
		}

		// Récupérer les paramètres du formulaire via GET
		$ValId_station = isset($_GET['IdStationA']) ? $_GET['IdStationA'] : '';
		$ValNumJour = isset($_GET['NumJourA']) ? $_GET['NumJourA'] : '';

		// Vérifier si les deux paramètres sont présents
		if ($ValId_station && $ValNumJour) {
			// Préparer la requête SELECT pour récupérer les données de la station au jour spécifié
			$requete = $Bdd->prepare('SELECT * FROM mesures WHERE id_station = :id_station AND date = :date');
			$requete->execute(array(
				'id_station' => $ValId_station,
				'date' => $ValNumJour
			));

			// Récupérer les données de la requête
			$donnees = $requete->fetch();
			if ($donnees) {
				// Afficher les résultats
				echo "La station " . htmlspecialchars($donnees['id_station']) . " a mesuré une température de " . htmlspecialchars($donnees['temperature']) . " degrés Celsius et un ensoleillement de " . htmlspecialchars($donnees['ensoleillement']) . " W/m² le jour " . htmlspecialchars($donnees['date']) . ".";
			} else {
				// Aucun résultat trouvé pour la station et la date spécifiées
				echo "Aucune donnée trouvée pour la station " . htmlspecialchars($ValId_station) . " au jour " . htmlspecialchars($ValNumJour) . ".";
			}
            
			$requete->closeCursor();
		} else {
			echo "Veuillez entrer à la fois l'ID de la station et le numéro du jour.";
		}

		// Fermer la connexion
		$Bdd = null;
		?>
	</p>

	<form action="gestion_stations.php" method="GET">
		<div>
			<input type="submit" value="RETOUR" />
		</div>
	</form>
</body>
</html>
