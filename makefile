start: ## Démarre le projet : construit les images et lance les containers
	./start.sh

schema: ## Modifie et valide le schéma puis migre vers la BDD
	./migrate.sh

migration: ## Applique juste les migrations existantes
	docker exec -it -w "/app" "esoternet_app-web-1" bash -c 'php bin/console doctrine:migration:migrate'

fixture: ## Déploie les fixtures en BDD
	docker exec -it -w "/app" "esoternet_app-web-1" bash -c 'php bin/console doctrine:fixtures:load --no-interaction'

resetdb: ## Supprime et recrée la base de données dans le container
	./resetdb.sh

entity: ## Créer ou modifier une entité
	php esoternet_app/bin/console make:entity