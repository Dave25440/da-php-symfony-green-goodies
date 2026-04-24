# Green Goodies - Site e-commerce de produits bio

## Description

Green Goodies est une boutique physique lyonnaise spécialisée dans la vente de produits biologiques, éthiques et écologiques. Elle souhaite développer son site pour élargir sa cible commerciale et recevoir des commandes de toute la France.  
Une API permet aux partenaires de Green Goodies d'afficher ses produits sur leur site.  
Ce projet est une première version fonctionnelle évolutive.

## Prérequis

- PHP 8.2 ou ultérieur
- Composer (gestionnaire de dépendances PHP) installé
- npm (gestionnaire de dépendances JavaScript) installé
- Symfony CLI installé
- Serveur web (exemple : Apache avec MAMP)
- Base de données MySQL ou équivalente

## Installation et utilisation

1. **Clonage du dépôt**

    ```bash
    git clone <url-du-projet>
    cd <dossier-du-projet>
    ```

2. **Installation des dépendances**

    ```bash
    composer install
    npm install
    ```

3. **Configuration**

    Dupliquez le fichier **.env** et renommez-le **.env.local**.

    Modifiez les informations suivantes si nécessaire :
    - Identifiants de connexion à la base de données
    - Chemin d'accès et passphrase des clés SSL

    Générez votre paire de clés privée et publique pour JWT :
    ```bash
    symfony console lexik:jwt:generate-keypair
    ```

4. **Base de données**

    **Méthode A : Génération des données**

    Créez la base de données :
    ```bash
    symfony console doctrine:database:create --if-not-exists
    ```

    Créez les tables :
    ```bash
    symfony console make:migration
    symfony console doctrine:migrations:migrate
    ```

    Chargez les fixtures :
    ```bash
    symfony console doctrine:fixtures:load
    ```

    **Méthode B : Utilisation de la sauvegarde**

    Importez le fichier **green_goodies.sql** dans votre base de données avec phpMyAdmin, Adminer ou directement en ligne de commande :
    ```bash
    mysql -u <utilisateur> -p <nom_de_la_base> < green_goodies.sql
    ```

5. **Lancement de l'application**

    Compilez les assets :
    ```bash
    npm run build
    ```

    Démarrez le serveur :
    ```bash
    symfony server:start -d
    ```

6. **Connexion au site**

    Créez un compte sur la page *Inscription* pour tester l'application.  
    Si vous avez importé **green_goodies.sql**, vous pouvez vous connecter avec **dave@mail.com** et le mot de passe **password**.

7. **Utilisation de l'API**

    Pour interroger les routes de l'API, activez au préalable votre **accès** (ROLE_API) sur la page *Mon compte*.

    **Authentification :** POST /api/login

    Corps JSON attendu :
    - username (string) : adresse email
    - password (string) : mot de passe

    Exemple :
    ```json
    {
        "username": "dave@mail.com",
        "password": "password"
    }
    ```

    Le token reçu doit ensuite être envoyé dans les requêtes sécurisées via le **header** :
    ```
    Authorization: Bearer <token>
    ```

    **Listage des produits :** GET /api/products

## Notes

- Les images du site sont optimisées au format WebP.
- Webpack Encore compile et minifie les fichiers CSS et JS.
- L'interface est stylisée avec le préprocesseur Sass et la syntaxe SCSS.