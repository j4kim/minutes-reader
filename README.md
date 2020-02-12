# Minutes Reader

A tool for those who like to write [MoMs](https://en.wikipedia.org/wiki/Minutes) in MarkDown files.

The files are read by PHP in back-end and displayed by Vue in front-end.

## Set up

Install PHP dependencies via [Composer](https://getcomposer.org/):
```
composer install
```

Install JavaScript dependencies via [npm](https://www.npmjs.com/):
```
npm install
```

## Develop

Run a PHP local server:
```
php -S localhost:1212
```

Then compile the app:
```
npx webpack
```

## Rules

* Have all MarkDown files in a folder accessible from `get_content.php`, the folder path is set in `.env`
* MarkDown file names start with a date in format `YYYY-MM-DD`
* First line of a MarkDown file contains `# ` followed by the title
* Last line of a MarkDown file contains `tags: ` followed by comma-separated tags
