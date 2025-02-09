# Esoternet
## The central hub of the esoteric internet
### The one place to book interdimensional services from your favorite entities

#### 1. Setup

Commandes à exécuter dans l'ordre à la racine du projet (dossier esoternet) :
1. `make start` puis suivre les prompts dans le terminal
2. `make migration` pour effectuer les migrations
3. `make fixture` pour charger la base de données avec des données de test

Ensuite, ouvrez votre navigateur et rendez vous à l'adresse `localhost:[VOTRE PORT]` pour commencer à explorer esoternet.

Ce projet utilise un makefile, le framework PHP Symfony et le gestionnaire de dépendances Composer. Assurez-vous d'avoir installé toutes les dépendances requises. Une fois le dépôt cloné, exécutez l'une des commandes suivantes :  

- `make start` : Si nécessaire, invite l'utilisateur à configurer le projet, puis construit les images et exécute les conteneurs.  
- `make migration` : Exécute toutes les migrations disponibles dans le conteneur de base de données.  
- `make schema` : Si vous modifiez le schéma de la base de données, met à jour la base de données, crée les migrations et les exécute.  
- `make fixture` : Charge les fixtures disponibles.  
- `make resetdb` : Supprime et recrée la base de données dans le conteneur.  
- `make entity` : Crée ou met à jour une entité en utilisant la CLI de Symfony.

## API Keys

Dans le fichier `.env`, les clés API de Stripe sont des clés de test, il n'y a donc aucun risque de sécurité associé à leur utilisation publique.

## Cartes de test

Pour tester les paiements, vous pouvez utiliser les cartes suivantes :

| MARQUE          | NUMÉRO                | CVC         | DATE                                  |
|-----------------|-----------------------|-------------|---------------------------------------|
| Visa            | 4242 4242 4242 4242   | 3 chiffres aléatoires | Toute date postérieure à la date du jour |
| Visa (débit)    | 4000 0566 5566 5556   | 3 chiffres aléatoires | Toute date postérieure à la date du jour |
| Mastercard      | 5555 5555 5555 4444   | 3 chiffres aléatoires | Toute date postérieure à la date du jour |
| Mastercard (série 2) | 2223 0031 2200 3222 | 3 chiffres aléatoires | Toute date postérieure à la date du jour |
| Mastercard (débit) | 5200 8282 8282 8210 | 3 chiffres aléatoires | Toute date postérieure à la date du jour |
| Mastercard (prépayée) | 5105 1051 0510 5100 | 3 chiffres aléatoires | Toute date postérieure à la date du jour |
