# Команды для работы с контейнером app
app:
	docker exec -it app $(filter-out $@,$(MAKECMDGOALS))

# Быстрые команды для часто используемых операций
shell:
	docker exec -it app bash

composer:
	docker exec -it app composer $(filter-out $@,$(MAKECMDGOALS))

php:
	docker exec -it app php $(filter-out $@,$(MAKECMDGOALS))

# Команды для управления проектом
install:
	docker exec -it app composer install

update:
	docker exec -it app composer update

# Команды для отладки
debug:
	docker exec -it app php -d xdebug.mode=debug $(filter-out $@,$(MAKECMDGOALS))

# Команды для тестирования
test:
	docker exec -it app php $(filter-out $@,$(MAKECMDGOALS))

# Команды для работы с файлами
ls:
	docker exec -it app ls -la $(filter-out $@,$(MAKECMDGOALS))

cat:
	docker exec -it app cat $(filter-out $@,$(MAKECMDGOALS))

# Помощь
help:
	@echo "Доступные команды:"
	@echo "  make shell          - Открыть bash в контейнере"
	@echo "  make composer ARG=install - Выполнить composer команду"
	@echo "  make php ARG=index.php - Выполнить PHP скрипт"
	@echo "  make install        - Установить зависимости"
	@echo "  make update         - Обновить зависимости"
	@echo "  make debug ARG=index.php - Запустить с отладкой"
	@echo "  make test ARG=test.php - Запустить тесты"
	@echo "  make ls ARG=/var/www/html - Показать файлы"
	@echo "  make cat ARG=index.php - Показать содержимое файла"
	@echo "  make app ARG='php -v' - Выполнить любую команду в контейнере"
