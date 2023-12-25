# Laravolt Tailored Override

## setup laravel/Laravolt
1.Creating new Laravel/Laravolt base

#Php 8 / Laravel 9
1. install Laravel 
 1. composer create-project laravel/laravel newbase
 	1. a) run application install
 	1. b) make sure Laravel page appear

1. get new Laravolt / run application install as Laravolt document
 1. cd into newbase folder
 1. composer require laravolt/Laravolt
 	1. a) php artisan laravolt:install
 	1. Salin .env.example ke .env
	1. Create and set your database configuration in .env
	```
	1. Run 'php artisan key:generate'
	1. Run 'php artisan migrate
	1. Run 'php artisan storage:link'
	1. Run 'php artisan vendor:publish --tag=laravolt-assets'
	```
	1. Pastikan folder-folder berikut _writeable_:
    	1. bootstrap/cache
    	1. storage
 	1. php artisan laravolt:admin Administrator admin@laravolt.dev secret


## Local Setup
1. Clone repository 

```
	git clone http://coders.3fresources.com/fezrul/3FOverdrive.git coders
```

1. add autoload composer.json

```
   "autoload": {
	    "files": [
            "coders/overdrive/web/src/helpers.php" --> add this
	    ],
    	"psr-4": {
        	"App\\": "app/",
        	"Overdrive\\Web\\": "coders/overdrive/web/src"  --> add this
    	}
    },
    "autoload-dev": {
        "psr-4": {
            "Tests\\": "tests/",
            "Overdrive\\Web\\": "coders/overdrive/web/src"   --> add this
        }
    }
	
```


1. register ServiceProvider in config/app.php
```
	Overdrive\Web\ServiceProvider::class
```
1. run composer dump-autoload

1. Install
```
run php artisan overide:asset
```
