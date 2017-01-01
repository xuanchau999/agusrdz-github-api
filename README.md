1. Create a new folder {vendor}-{name}. Ex. agusrdz-github-api

  `mkdir -p agusrdz-github-api && cd agusrdz-github-api`

2. Init your repo

  `git init`

3. Init composer

  `composer init`

  This command will guide you through creating your composer.json file.


4. Set package name `vendor/name`, in this case `agusrdz/github-api`

5. Add a package description

6. Add an author: Your name <your@email.com>

7. Add minimum stability for package: dev

8. Define your dependencies (require) for production manually instead interactively

9. Define your dependencies (require-dev) for development manually instead interactively.

```
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
```

10. Confirm the generation of composer.json file

11. Confirm if you want thaht the vendor directory added to your .gitignore file

12. Now add all dependencies required to use the package, for example:

```
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
```
13. The next steps are create two folders called:

`src` and `tests`

`mkdir -p src tests`

14. Inside `src` folder we need create the folders required for our package, in this example I'll create the folders `Facades` and `Providers`.

15. Now we'll mapping the src folders to psr-4 convention on the composer.json to autoload the package on start application

```
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
```

16. Run

`composer install`
