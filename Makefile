
#Author: Martin Pech
PROJECT = SIMPLO_API

default:
	composer create-project laravel/laravel API
	mv API .API
	rsync -I -a * .API
	mv Makefile .Makefile
	rm -rf *
	mv .Makefile Makefile
	mv .API API
	mv API/README.md .
	rm -rf Makefile


prepareDatabase:
	php artisan migrate:fresh

server:
	php artisan serve
