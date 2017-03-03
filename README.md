# _Salon Manager_

#### _Application to demonstrate database interaction with mysql and php.  Created March 2017._

#### By _**Zach Swanson**_

## Description

_This is a simple application designed to demonstrate interaction with a mysql database using php.  The application is a utility for a salon manager to organize the stylists they employ, along with those stylist's client lists.  The app will communicate with a mysql database and allow all basic CRUD functionality across two tables of records._

## Application Behaviors

Application behaviors are organized along RESTful principles.  The application has two primary resources: Stores and Brands.  The application has two sets of behaviors for handling these resources; one set for handling the resource as a list and another for handling the specific element of that list.  Routes in the application are organized around these behaviors.

|Resource:| Store List ||
| ------ | ------ | ------ |
| Feature Category | Behaviors | Use Examples|
| Display: | Page displays a list of all Stores and their details | "ShoEmporium, Fancy Feet, etc." |
|Navigation: | Nav features to visit a specific Store or the list of Brands| "click on a store button to visit specific page" |
|Input: | Forms for adding new store to list, button to delete all stores | "Forms are completed, new store appears in list"|

|Resource:| Brand List ||
| ------ | ------ | ------ |
| Feature Category | Behaviors | Use Examples|
| Display: | Page displays a list of all Brands and their details | "Neekus, Reeblik, etc." |
|Navigation: | Nav features to visit a specific Brand or the list of Stores| "click on a brand button to visit specific page" |
|Input: | Forms for adding new Brand to list, button to delete all Brands | "Forms are completed, new Brand appears in list"|

|Resource:| Specific Store ||
| ------ | ------ | ------ |
| Feature Category | Behaviors | Use Examples|
| Display: | Page displays a list of current store's details and list of store's brands | "ShoEmporium - market segment: discount.  Brands: Neekus, Reeblik" |
|Navigation: | Nav features to visit a specific Brand or the lists of Brands or Stores | "click on a store button to visit specific page" |
|Input: | Forms for editing current store details, adding brands to current store, button to delete current store | "Add Form is completed, new brand appears in list", "edit form is completed, store details are updated in display"|


|Resource:| Specific Brand ||
| ------ | ------ | ------ |
| Feature Category | Behaviors | Use Examples|
| Display: | Page displays a list of current brand's details and list of brand's stores | "Neekus - target market: upscale athletic.  Stores: ShoEmporium, Fancy Feet" |
|Navigation: | Nav features to visit a specific Brand or the lists of Brands or Stores | "click on a brand button to visit specific page" |
|Input: | Forms for editing current brand details, adding stores to current brand, button to delete current brand | "Add Form is completed, new store appears in list", "edit form is completed, brand details are updated in display"|

## Setup/Installation Requirements

* This application requires the Silex framework and Twig templating engine, as well as the Composer dependency manager.  Unit testing was done with with the PHPUnit framework.  The application is designed to work with a mysql database using a PHP PDO object.   
* To install, make sure that you have composer installed (https://getcomposer.org/), clone this repository from github, and run "composer install" from the project directory in terminal.  This will install the required dependencies in the project directory.
* To configure the database, either import the zipped database  contents from the "data" folder into your mysql database or manually create databases (production and test) to mirror their structure.  Directions for manual creation on a MAMP server using mySQL and Apache are below.
* To run the application, you will need to run a local server running php in the "web" folder of the project directory Application was tested using MAMP: https://www.mamp.info/en/.  To configure, be sure that MAMP's Apache port is set to 8888, it's mysql port is set to 8889, and that the document root is set to the 'web' folder in the project directory.  Then direct any browser to your local server (socket 8888) to run.
* To replicate testing, navigate to the project directory in terminal (after composer install) and run the command "./vendor/bin/phpunit tests".  The specific tests may be viewed in ./tests/.


* Database configuration:
* Launch MAMP and start servers, then run /Applications/MAMP/Library/bin/mysql --host=localhost -u(username) -p(password) in the command line, then enter the following commands:
* CREATE DATABASE shoes;
* USE shoes;
* CREATE TABLE stores (id serial PRIMARY KEY, name VARCHAR (255),target_market VARCHAR(255));
* CREATE TABLE brands (id serial PRIMARY KEY, name VARCHAR(255), market_segment VARCHAR(255));
CREATE TABLE stores_brands (id serial PRIMARY KEY, store_id INT, brand_id INT);
* Then use either uses similar commands or use MAMP'S myphpadmin to copy the structure of this database into another called hair_salon_test.  The PHPUnit testing suite will use this database when you replicate the unit tests.


## Known Bugs

 _No current method to escape data being sent to database, so inputs containing special characters (i.e. "Zach's") may cause failure to write to database.  Also, no protection against SQL injection, so someone may steal my imaginary hair salon data :)_

## Support and contact details

_Created by Zach Swanson, zach.j.swanson@gmail.com.  No ongoing support planned, but questions or comments are welcome._

## Technologies Used

_Written in Atom text editor, using PHP, Silex, and Twig.  Tested functionality with PHPUnit and user interface on a local server with MAMP._

### License

*MIT license*

Copyright (c) 2017 **_Zach Swanson_**
