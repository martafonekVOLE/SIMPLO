# SIMPLO - PHP developer assignment
The goal of this project was to create a simple API. This application is used for managing customers and their relations with different groups.
Author: [Martin Pech](https://mpech.net/developer)

## First run
1) Run mysql and create empty database
2) Run `make` to build the project. Then edit *.env* file (DB_DATABASE, DB_USERNAME, DB_PASSWORD)
3) Run `make database`, alternatively run `php artisan migrate`
> NOTE: *This will create database tables and fill them with testing data*
4) Run `make server`, or `php artisan serve`
5) Start using API 

## Examples
> NOTE: *Examples are shown on localhost*

`127.0.0.1:8000/api/v1/customer` - shows list of customers, accepts **GET, POST**

`127.0.0.1:8000/api/v1/customer?includeGroup=true` - shows list of customers with assigned groups

`127.0.0.1:8000/api/v1/customer/1/` - shows customer with id = 1, accepts **PUT, DELETE**

`127.0.0.1:8000/api/v1/customer/1/group` - shows groups of customer with id = 1, accepts **GET, POST**

`127.0.0.1:8000/api/v1/customer/1/group/2/` - shows group with id = 2 of customer with id = 1, accepts **PUT, DELETE**
