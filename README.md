# Esoternet
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
