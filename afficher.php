<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Afficher les données</title>
	<link rel="stylesheet" href="stylegestionstation.css" />
	<?PHP
	/*Mettre ci-dessous les codes en PHP permettant de récupérer
	tous les paramètres des formulaires de la page "gestion_stations.php"
	par la méthode "GET"
	Vous pourrez prévoir leur affichage via la commande PHP "echo" qu'il faudra enlever par la suite*/

	
	/*Mettre ci-dessous le code permettant la connexion à la BDD SQL "gestion_stations
	via la méthode PDO*/

		
	/*Mettre ci-dessous le code permettant de préparer la requête "SELECT" sans les
	paramètres des formulaires*/

	
	//$reponse = $Bdd->query('INSERT INTO mesures(temperature, ensoleillement, date, id_station) VALUES (\"$ValTemp\",\"$ValEns\",\"$ValJour\")');//methode directe sans requête préparée
	
	/*Mettre ci-dessous le code pour exécuter la requête en précisant
	les paramètres dans un tableau*/


	?>
</head>
	<body>
		<h1>
			INTERFACE DE GESTION DES STATIONS METEOROLOGIQUES.
		</h1>
		<p>
			Votre premier bout de code permmettant d'afficher des données issues d'une requête vers une Bdd : Bravo si çà fonctionne en vérifiant dans PhpMyAdmin !<BR>			
			<?PHP
			/*Mettre ici le code qui permet d'extraire la température et l'ensoleillement SQL*/

			?>
			La station <?PHP   ?> a mesuré une température de <?PHP  ?> degrés Celsius et un ensoleillement de <?PHP  ?> W/m² le <?PHP  ?> jour.
			<?PHP $requete->closeCursor() ; ?>
		</p>
		<form action="gestion_stations.php" method="GET">
			<div>
				<input type="submit" value="RETOUR"/>
			</div>
		</form>
	</body>
</html>
