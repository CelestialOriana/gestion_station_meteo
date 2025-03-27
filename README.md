# Système de Gestion de Stations Météorologiques

Ce projet est une interface web pour gérer des données de stations météorologiques. Il permet d'insérer, afficher et supprimer des données météorologiques pour différentes stations.

## Fonctionnalités

- **Insertion de données**: Ajouter des mesures de température et d'ensoleillement pour une station spécifique à une date donnée
- **Affichage de données**: Consulter les données d'une station pour une date spécifique
- **Suppression de données**: Supprimer les enregistrements d'une station pour une date spécifique
- **Affichage graphique**: Visualiser les données météorologiques avec des représentations graphiques adaptées aux valeurs

## Structure du projet

```
gestion_station_meteo/
├── affichage_graphique.php  # Visualisation graphique des données météo
├── afficher.php             # Affichage textuel des données
├── effacer.php              # Suppression des données
├── gestion_stations.html    # Interface principale avec formulaires
├── inserer.php              # Insertion de nouvelles données
├── php_mysql.php            # Test de connexion à la base de données
├── stylegestionstation.css  # Styles CSS pour l'interface
└── images/                  # Dossier contenant les images pour la visualisation
    ├── direction_n.png      # Direction du vent Nord
    ├── direction_e.png      # Direction du vent Est
    ├── direction_s.png      # Direction du vent Sud
    ├── direction_o.png      # Direction du vent Ouest
    ├── pluie_faible.png     # Faible précipitation
    ├── pluie_moyen.png      # Précipitation moyenne
    ├── pluie_forte.png      # Forte précipitation
    ├── soleil.png           # Pas de précipitation
    ├── temperature_froid.png # Température basse
    ├── temperature_moyen.png # Température moyenne
    ├── temperature_chaud.png # Température élevée
    ├── vent_faible.png      # Vent faible
    ├── vent_moyen.png       # Vent modéré
    ├── vent_fort.png        # Vent fort
    ├── s1.jpg               # Image station 1
    ├── s2.jpg               # Image station 2
    ├── s3.jpg               # Image station 3
    └── s4.jpg               # Image station par défaut
```

## Base de données

Le projet utilise une base de données MySQL nommée `gestion_station` avec la structure suivante:

### Table `mesures`
- `id_station` (varchar) : Identifiant de la station (s1, s2, s3)
- `date` (varchar) : Date de la mesure
- `temperature` (float) : Température en degrés Celsius
- `ensoleillement` (float) : Ensoleillement en W/m²

### Améliorations possibles
Pour une version plus complète, il serait utile d'ajouter:
- Une table `stations` avec informations détaillées sur chaque station
- Des colonnes pour vitesse du vent et direction du vent dans la table `mesures`

## Installation

1. Cloner ce dépôt dans le répertoire web de votre serveur (ex: `/var/www/html/` pour Apache)
2. Créer la base de données MySQL:
   ```sql
   CREATE DATABASE gestion_station;
   USE gestion_station;
   
   CREATE TABLE mesures (
     id INT AUTO_INCREMENT PRIMARY KEY,
     id_station VARCHAR(10) NOT NULL,
     date VARCHAR(10) NOT NULL,
     temperature FLOAT NOT NULL,
     ensoleillement FLOAT NOT NULL
   );
   ```
3. Vérifier que PHP et MySQL sont correctement configurés sur votre serveur
4. Accéder à l'application via `http://localhost/gestion_station_meteo/gestion_stations.html`

## Utilisation

1. Sur la page principale, choisissez l'opération souhaitée (insérer, afficher ou supprimer)
2. Remplissez les formulaires avec les informations requises:
   - ID de la station (s1, s2 ou s3)
   - Numéro du jour
   - Valeurs de température et d'ensoleillement (pour l'insertion uniquement)
3. Cliquez sur le bouton "Valider" pour exécuter l'opération

## Captures d'écran

*Des captures d'écran du système peuvent être ajoutées ici*

## Auteur

*Votre nom ici*

## Licence

*Informations sur la licence, le cas échéant*