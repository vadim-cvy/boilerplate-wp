# Boilerplate for WP theme

## Installation
1. Search & replace namespace related occurancies:
    * "MyApp"
    * "MYAPP"
    * "myapp"
2. Search for "todo" and follow the instructions.
3. Execute `composer install`.
4. Execute `npm install`.
5. Remove example dirs from `./assets/src/js/` and `./assets/src/css/`.
6. See debug log. Hints (errors) will appear there to guide you on the further things that must be done (if any).

## PHP Development
1. All includes must be stored at `/inc`.
2. Autoload follows PSR-4 standard. Ex: `\MyApp\DirName\ClassName` = `./inc/DirName/ClassName.php`.

## JS & CSS Development
1. `npm run watch` - watches './assets/src/` files changes and compiles them into './assets/dist/`.
    * `/assets/src/css/your/path/to/index.scss` will be compiled into `/assets/dist/css/your/path/to/index.css`.
    * `/assets/src/js/your/path/to/index.ts` will be compiled into `/assets/dist/js/your/path/to/index.js`.
