Create a new folder {vendor}-{name}. Ex. agusrdz-github-api

mkdir -p agusrdz-github-api && cd agusrdz-github-api

Init your repo

git init

Init composer

composer init

This command will guide you through creating your composer.json file.

Set package name vendor/name, in this case agusrdz/github-api

Add a package description

Add an author: Your name your@email.com

Add minimum stability for package: dev

Define your dependencies (require) for production manually instead interactively

Define your dependencies (require-dev) for development manually instead interactively.

{
    "name": "juniorgrossi/hello-world",
    "description": "My first Composer project",
    "authors": [
        {
            "name": "Your Name",
            "email": "your@name.com"
        }
    ],
    "minimum-stability": "dev",
    "require": {

    }
}
Confirm the generation of composer.json file

Confirm if you want thaht the vendor directory added to your .gitignore file

Now add all dependencies required to use the package, for example:

  {
    "name": "agusrdz/github-api",
    "description": "This is a demo package to use the API of Github.",
    "type": "package",
    "license": "MIT",
    "authors": [
        {
            "name": "Agustin Espinoza",
            "email": "agustinurdz_@hotmail.com"
        }
    ],
    "minimum-stability": "dev",
    "require": {
      "php": ">=5.6"
    },
    "require-dev": {
      "phpunit/phpunit": "~5.0",
      "phpunit/phpunit-mock-objects": "~3.0"
    }
  }
The next steps are create two folders called:
src and tests

mkdir -p src tests

Inside src folder we need create the folders required for our package, in this example I'll create the folders Facades and Providers.

Now we'll mapping the src folders to psr-4 convention on the composer.json to autoload the package on start application

  {
    "name": "agusrdz/github-api",
    "description": "This is a demo package to use the API of Github.",
    "type": "package",
    "license": "MIT",
    "authors": [
        {
            "name": "Agustin Espinoza",
            "email": "agustinurdz_@hotmail.com"
        }
    ],
    "minimum-stability": "dev",
    "require": {
      "php": ">=5.6"
    },
    "require-dev": {
      "phpunit/phpunit": "~5.0",
      "phpunit/phpunit-mock-objects": "~3.0"
    },
    "autoload": {
      "psr-4": {
        "AgusRdz\\GitHub\\": "src/"
      }
    }
  }
Run
composer install