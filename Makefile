up:
	./vendor/bin/sail up -d

down:
	./vendor/bin/sail down

bash:
	./vendor/bin/sail bash

composer:
	./vendor/bin/sail composer install

migrate:
	./vendor/bin/sail php artisan migrate:fresh --seed

test:
	./vendor/bin/sail php artisan test

swagger:
	./vendor/bin/sail php artisan l5-swagger:generate
