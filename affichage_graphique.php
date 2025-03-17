<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="stylegestionstation.css" />
	<title>Interface de gestion des stations</title>
</head>
	<body>
	<?php
		//Mettre ici, le code PHP pour récupérer toutes les données du formulaire de saisie
		$NomStation =  $_GET['IdStationI'];

	?>
		<h1>
			AFFICHAGE DES MESURES ET INTERPRETATIONS
		</h1>
		<!--TABLEAU DE SAISIE-->
		<p>
			<FORM class="formulaire1">
				<fieldset>
					<table>
						<tr>
							<th>Nom de la station</th>
							<th>Température</th>
							<th>Précipitation</th>
							<th>Vitesse du vent</th>
							<th>Direction du vent</th>
						</tr>
						<!-- 2ième ligne du tableau -->
						<tr>
							<!--Ligne du tableau qui récapitule les information de saisie pour l'exercice de synthese -->
							<td>
								<?php //mettre ici le code PHP permettand d'afficher le nom de la station
									
								?>
							</td>
							<td>
								<?php //mettre ici le code PHP permettand d'afficher la température
									
								?>
							</td>
							<td>
								<?php //mettre ici le code PHP permettand d'afficher la valeur de précipitation
									
								?>
							</td>
							<td>
								<?php //mettre ici le code PHP permettand d'afficher la valeur de vitesse de vent
									
								?>
							</td>
							<td>
								<?php //mettre ici le code PHP permettand d'afficher la direction du vent
									
								?>
							</td>
						</tr>
						<!-- 3ième ligne du tableau -->
						<tr>
							<td>
								<?php //mettre ici le code PHP permettand d'afficher l'image de la station

								?>
							</td>
							<td>
								<?php //mettre ici le code PHP permettand d'afficher l'image de la température

								?>
							</td>
							<td>
								<?php //mettre ici le code PHP permettand d'afficher l'image des précipitations

								?>
							</td>
							<td>
								<?php //mettre ici le code PHP permettand d'afficher l'image de la vitesse du vent

								?>
							</td>
							<td>
								<?php //mettre ici le code PHP permettand d'afficher l'image de la direction du vent

								?>
							</td>
						</tr>
					</table>
				</fieldset>
			</FORM>
		</p>
	</body>
</html>
