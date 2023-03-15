# SIMPLO - PHP developer assignment
The goal of this project was to create a simple API. This application is used for managing customers and their relations with different groups.
Author: [Martin Pech](https://mpech.net/developer)

## First run
1) Run `make` to build the project. Project will be ready in API directory.
2) Run mysql and create empty database. 
3) Edit *.env* file (DB_DATABASE, DB_USERNAME, DB_PASSWORD).
4) Run `make database`, alternatively run `php artisan migrate:fresh`.
> NOTE: *This will create database tables and fill them with testing data*
4) Run `make server`, or `php artisan serve`.
5) Start using API.

## Examples
> NOTE: *Examples are shown on localhost*

`127.0.0.1:8000/api/v1/customer` - list of customers, accepts **GET, POST**

`127.0.0.1:8000/api/v1/customer?includeGroup=true` - list of customers with assigned groups

`127.0.0.1:8000/api/v1/customer/1/` - detail of customer with id = 1, accepts **PUT, PATCH, DELETE**

`127.0.0.1:8000/api/v1/customer/1/group` - groups of customer with id = 1, accepts **GET, POST**

`127.0.0.1:8000/api/v1/customer/1/group/2/` - detail of group with id = 2 of customer with id = 1, accepts **PUT, PATCH, DELETE**
