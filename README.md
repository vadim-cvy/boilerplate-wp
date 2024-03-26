# Boilerplate for WP theme

## Installation
1. Search & replace namespace related occurancies:
    * "MyApp"
    * "MYAPP"
    * "myapp"
2. Search for "todo" and follow the instructions.
3. Execute `composer install`.
4. Execute `npm install`.
5. Define constants described in "Required PHP Constants" section (bellow) in `wp-config.php`.
6. Remove example dirs from `./assets/src/js/` and `./assets/src/css/`.

## Migration
1. Define constants described in "Required PHP Constants" section (bellow) in `wp-config.php`.

## Required PHP Constants
* `MYAPP_IS_GRIDPANE`: `true` / `false`.
* `MYAPP_ENV`: `"loc"` / `"stg"` / `"prod"`.

## Development
* PHP
    * All includes must be stored at `/inc`.
    * Autoload follows PSR-4 standard. Ex: `\MyApp\DirName\ClassName` = `./inc/DirName/ClassName.php`.
* JS & CSS
    * `npm run watch` watches `./assets/src/` files changes and compiles them into `./assets/dist/`.
        * `/assets/src/css/your/path/to/index.scss` will be compiled into `/assets/dist/css/your/path/to/index.css`.
        * `/assets/src/js/your/path/to/index.ts` will be compiled into `/assets/dist/js/your/path/to/index.js`.
