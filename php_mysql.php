<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
	<title>Connexion à une BDD</title>
	<?PHP
	try
		{
			$Bdd = new PDO('mysql:host=localhost;dbname=gestion_stations', 'root', '') ;
		}
	catch (Exception $e)
		{
			die ('Erreur de connexion ? : '. $e->getMessage()) ;
		}
	?>
</head>
	<body>	
		<p>
			Le premier bout de code pour se connecter à une base de données V1.
		</p>
	</body>
</html>
