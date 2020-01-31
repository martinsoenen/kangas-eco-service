EXEC_PHP        = php
SYMFONY         = $(EXEC_PHP) bin/console
COMPOSER        = composer


##### SYMFONY #####
help:
	$(SYMFONY)
cache :
	$(SYMFONY) cache:warmup

##### DOCTRINE #####
database:
	$(SYMFONY) doctrine:database:create --if-not-exists
	$(SYMFONY) doctrine:schema:drop --full-database --force
	$(SYMFONY) doctrine:schema:update --force
	$(SYMFONY) doctrine:migrations:migrate --no-interaction --allow-no-migration

migration:
	$(SYMFONY) doctrine:migrations:diff

entities:
	$(SYMFONY) make:entity --regenerate App

entity:
	$(SYMFONY) make:entity