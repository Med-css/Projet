# Mon Projet Dev

Une brève description de votre projet et de son but.

<br />

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre machine :

- [Docker](https://www.docker.com/get-started)

<br />

## Installation

1. Clonez ce dépôt sur votre machine locale :

   ```bash
   git clone https://github.com/Med-css/Projet.git
   ```
   
2. Accédez au répertoire du projet :

   ```bash
   cd Projet
   ```

<br />

## Utilisation

1. Construisez l'image Docker :

   ```bash
   docker build -t projet-dev .
   ```
   
2. Exécutez le conteneur Docker :

   ```bash
   docker run -p 8082:8082 -v ${PWD}:/var/www/html projet-dev
   ```

3. Ouvrez votre navigateur et accédez à l'application à l'adresse suivante :

   - [http://localhost:8082/](http://localhost:8082/)
