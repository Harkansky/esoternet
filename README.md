comm# Esoternet
## The central hub of the esoteric internet
### The one place to book interdimensional services from your favorite entities

#### 1. Setup

This project uses a makefile, the Symfony php framework and the Composer dependencies manager. Make sure you have all requirements installed. Once the repository is cloned, run one of the commands :

- `make start` : If needed, prompts the user to configure the project, then builds images and runs containers.
- `make migration` : Runs all available migrations in the database container.
- `make schema` : If you modify the database schema, updates the database, creates migrations and executes them.
- `make fixture` : Loads avilable fixture.
- `make resetdb` : Deletes and re-creates the database in the container.
- `make entity` : Creates or updates a new entity using Symfony CLI.

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
