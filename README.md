# laravel-maintenance
Use Laravel with the plugin maintenance

1. [Features](#features)
2. [Installation](#installation)
3. [Usage](#usage)
4. [Options](#options)

----

<a id="features"></a>
## Features
- Add Maintenance Gestion in your application

<a id="installation"></a>
## Installation

In your project base directory run

	composer require "dlouvard/laravel-maintenance":"master@dev"
	
To bring up the config file run, if you want to customize

	php artisan vendor:publish
	php artisan migrate
	
Then edit `config/app.php` and add the service provider within the `providers` array.

	'providers' => array(
		...
		Dlouvard\LaravelGestionmaintenance\GestionmaintenanceServiceProvider::class,

<a id="usage"></a>
## Usage
Middleware : 
Add `\Dlouvard\LaravelGestionmaintenance\Middleware\MaintenanceMiddleware::class` in $middlewareGroups -> 'web' in app/kernel.php

View for login : @include('vendor.maintenances._maintenance_login')

View for header : @include('vendor.maintenances._maintenance_header')





