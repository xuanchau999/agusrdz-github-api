Creating a custom Composer package from scratch
==================================

# What is Composer?

Composer is a dependency manager for PHP. Composer will manage the 
dependencies you require on a project by project basis. This means that Composer will pull in all the required libraries, dependencies and manage them all in one place.

In this post I'll learn to you how to create a custom package using composer to consume the GitHub API, well in order to create a custom composer package you need create the folder structure, for example:

```
|- vendor/name
  |- src
    |- Contracts
    |- Models
    |- Providers
  |- tests
  |- vendor
```

After create the base structure, in the terminal type:

```
git init #initialize git tracking
composer init #this command will guide you throuhg creating your composer.json file
```

#### composer.json file configuration

1. Set package name vendor/name, in this case :`agusrdz/github-api`.
2. Add a package description: `This is a demo package to use the API of Github.`.
3. Add an author: `Your name` `your@email.com`.
4. Add minimum stability for package: `dev`.
5. Define your dependencies (require) for production manually instead interactively.
6. Define your dependencies (require-dev) for development manually instead interactively.
7. Confirm the generation of composer.json file.
8. Confirm if you want that the `vendor` directory added to your .gitignore file.
9. Now you only need add all dependencies required to use the package.
10. After edit the composer.json file run `composer install` on your terminal.

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
      "php": ">=5.6",
        "guzzlehttp/guzzle": "^6.1",
        "jenssegers/model": "^1.1"
    },
    "require-dev": {
      "phpunit/phpunit": "~5.0",
        "phpunit/phpunit-mock-objects": "~3.0",
        "illuminate/support": "^5.3"
   }
}
```

That's it!!!

Well, almost that's it... basically this is the composer.json required to create a composer package but we need add some lines more to define the parameters as autoload, unit test and prefered stability; so go to composer.json and add this after `required-dev`.

```
"require-dev": {
  "phpunit/phpunit": "~5.0",
    "phpunit/phpunit-mock-objects": "~3.0",
    "illuminate/support": "^5.3"
},
"autoload": {
  "psr-4": {
      "AgusRdz\\GitHub\\": "src/"
    }
},
"autoload-dev": {
  "classmap": [
      "tests/TestCase.php"
    ]
}
```

And then add the phpunit.xml file on root folder to run the unit test, it is highly recommended to do unit test when developing this type of packages.

```
<?xml version="1.0" encoding="UTF-8"?>
<phpunit backupGlobals="false"
         backupStaticAttributes="false"
         bootstrap="vendor/autoload.php"
         colors="true"
         convertErrorsToExceptions="true"
         convertNoticesToExceptions="true"
         convertWarningsToExceptions="true"
         processIsolation="false"
         stopOnFailure="false"
         syntaxCheck="false"
        >
    <testsuites>
        <testsuite name="Your package's test suit">
            <directory>./tests/</directory>
        </testsuite>
    </testsuites>
</phpunit>
```

Finally we are already to create the logic of this package.
You can visit the [repo](https://github.com/AgusRdz/agusrdz-github-api) to see all code and check this [demo](https://github.com/AgusRdz/github-api-demo) based on Laravel to see how it works.