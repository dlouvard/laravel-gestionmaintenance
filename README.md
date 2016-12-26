# laravel-maintenance
Use Laravel with the plugin maintenance

This repo use https://github.com/sthielen/BigUpload, you must import JS/CSS in your application.

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
	
Then edit `config/app.php` and add the service provider within the `providers` array.

	'providers' => array(
		...
		Dlouvard\LaravelMaintenance\MaintenanceServiceProvider::class,

<a id="usage"></a>
## Usage


<a id="options"></a>
## Options

I propose a customization file for the bigupload.js send cancel function



