EXEC_PHP        = php
SYMFONY         = $(EXEC_PHP) bin/console
COMPOSER        = composer

##### DOCTRINE #####
database:
	$(SYMFONY) doctrine:schema:drop --full-database --force
	$(SYMFONY) doctrine:schema:update --force
	$(SYMFONY) doctrine:migrations:migrate --no-interaction --allow-no-migration
	$(SYMFONY) doctrine:fixtures:load --no-interaction

migration:
	$(SYMFONY) doctrine:migrations:diff

entity:
	$(SYMFONY) make:entity