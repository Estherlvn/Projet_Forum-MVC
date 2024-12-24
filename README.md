# Projet de Forum en PHP

Ce projet consiste en la création d'un forum en ligne utilisant PHP, MySQL, HTML, et CSS. L'objectif est de fournir une plate-forme de communication simple et intuitive où les utilisateurs peuvent s'inscrire, se connecter, créer des sujets et y répondre.
Le projet est réalisé selon le modèle MVC (Model-View-Controller) pour une meilleure organisation et maintenabilité du code.

## Technologies Utilisées

### Frontend

- **HTML5** : Structure de base des pages web.
- **CSS3** : Style et mise en page des éléments HTML.
- **JavaScript** : Interactivité côté client.

### Backend

- **PHP** : Langage de script côté serveur pour gérer la logique de l'application.
- **PDO (PHP Data Objects)** : Interface pour accéder aux bases de données en PHP, assurant des interactions sécurisées avec MySQL.

### Base de Données

- **MySQL** : Système de gestion de base de données relationnelle pour stocker les données des utilisateurs, sujets et messages.
- **HeidiSQL** : Outils pour gérer et administrer la base de données MySQL.

## Architecture MVC

- **Model (Modèle)** : Représente les données de l'application. Il gère la logique de données et les interactions avec la base de données.
- **View (Vue)** : Présente les données aux utilisateurs. Elle affiche les informations dans un format approprié et interactif.
- **Controller (Contrôleur)** : Gère les entrées utilisateur et met à jour les modèles et les vues en conséquence.

## Fonctionnalités

### Utilisateurs

- **Inscription des utilisateurs :**
  - Formulaire d'inscription avec validation des données.
  - Hashage des mots de passe avant enregistrement.
  - Insertion des informations des utilisateurs dans la base de données.

- **Connexion des utilisateurs :**
  - Formulaire de connexion avec validation des informations.
  - Vérification des identifiants et création de sessions utilisateur.

- **Déconnexion des utilisateurs :**
  - Destruction des sessions pour déconnecter les utilisateurs.

### Sujets

- **Affichage des sujets :**
  - Récupération et affichage des sujets de la base de données.
  - Tri des sujets par date de création dans l'ordre antéchronologique.

- **Création de nouveaux sujets :**
  - Formulaire de création de sujet avec validation.
  - Insertion de nouveaux sujets dans la base de données.

### Messages

- **Affichage des messages dans un sujet :**
  - Récupération et affichage des messages associés à un sujet spécifique.
  - Affichage des messages dans l'ordre chronologique.

- **Ajout de nouveaux messages :**
  - Formulaire d'ajout de message avec validation.
  - Insertion de nouveaux messages dans la base de données.

### Modération

- **Modération des contenus :**
  - Interface d'administration pour modérer et gérer les sujets, posts.
  - Mise à jour de l'état des messages et des sujets (ouvert, fermé).

### Sécurité

- **Sécurité des données :**
  - Utilisation de requêtes préparées pour prévenir les injections SQL.
  - Hashage des mots de passe avec des algorithmes sécurisés.
  - Validation des entrées utilisateur pour prévenir les attaques XSS.
