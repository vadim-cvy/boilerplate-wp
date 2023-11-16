# Boilerplate for WP plugins and themes

---

## Installation

### Theme
1. Remove `theme.` name part from `theme.functions.php` and `theme.style.css` files.
2. Remove `plugin.plugin-name.php`.
3. Update theme details in `style.css`.
4. Follow instruction from "Common" section (below).

### Plugin
1. Rename `plugin.plugin-name.php` file to `{your-plugin-dir-name}.php`.
2. Remove files starting with `theme.`.
3. Update plugin details in `{your-plugin-dir-name}.php`.
4. Follow instruction from "Common" section (below).

### Common
1. Execute `composer install`.
2. Execute `npm install`.

---

## Development

### PHP
1. All includes must be stored at `/inc`.
2. Autoload follows PSR-4 standard. Ex: `\MyApp\DirName\ClassName` = `./inc/DirName/ClassName.php`.
3. See `composer.json` >> `repositories` to view my utility packages which will help in dev process and will allow you to keep the same structure and common code base between different projects.

### JS & CSS
1. `/assets/src/css/{entry-point-name}/index.scss` will be compiled into `/assets/dist/css/{entry-point-name}.css`.
2. `/assets/src/js/{entry-point-name}/index.ts` will be compiled into `/assets/dist/js/{entry-point-name}/index.{dev|prod}.js`.
3. Commands
    * `npm run dev` - watches source files changes and compiles dev assets. Should be used during development.
    * `npm run build` - generates production ready assets.