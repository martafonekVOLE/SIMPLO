# SIMPLO - PHP developer assignment
The goal of this project was to create a simple API. This application is used for managing customers and their relations with different groups.
Author: [Martin Pech](https://mpech.net/developer)

## First run
1) Run mysql and create empty database `SIMPLO`
2) Run `make database`, alternatively run `php artisan migrate`
> NOTE: *This will create database tables and fill them with testing data*
3) Run `make server`, or `php artisan serve`
4) Use API 

## Examples
> NOTE: *Examples are shown on localhost*

`127.0.0.1:8000/api/v1/customer` - shows list of customers, accepts **GET, POST**

`127.0.0.1:8000/api/v1/customer?includeCategory=true` - shows list of customers with assigned groups

`127.0.0.1:8000/api/v1/customer/1/` - shows customer with id = 1, accepts **PUT, DELETE**

`127.0.0.1:8000/api/v1/customer/1/category` - shows groups of customer with id = 1, accepts **GET, POST**

`127.0.0.1:8000/api/v1/customer/1/category/2/` - shows group with id = 2 of customer with id = 1, accepts **PUT, DELETE**
