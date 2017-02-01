Creating a custom Composer package from scratch
==================================

# What is Composer?

Composer is a dependency manager for PHP. Composer will manage the 
dependencies you require on a project by project basis. This means that Composer will pull in all the required libraries, dependencies and manage them all in one place.

You are probably asking yourself how this can give you some benefit, well, just imagine that you are working on a project and write a couple of classes to handle certain actions, time after you start a new project and you need to reuse those features and you use the traditional Copy and Paste, this time you optimize it a little more, now you have two versions of the same functionalities so now copy the new version and replace it in the first project... suppose that instead of 2 projects are 20, it's crazy to think that this rudimentary process must be performed every time the code is adjusted to work. This is where the idea of ​​creating a package that encompasses these functionalities is the best option, since it can be versioned to be used according to the characteristics of the project and giving a greater support facility, I mean that only the code of update a repository, and projects can be updated with a few simple steps... even more, the entire community could have access to it and use it in thousands of projects.

In this post You'll learn how to create a custom package using composer to consume the GitHub API, well in order to create a custom composer package you need to create the folder structure, for example:

```
|- vendor/name
  |- src
    |- Contracts
    |- Models
    |- Providers
  |- tests
  |- vendor
```

After to create the base structure, in the terminal type:

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

As you can see creating packages with composer is very easy, in this example some of the functionality provided by the GitHub API is consumed and best of all it can be used from any project that manages its dependencies with composer, if you want to see the result you can visit this repository(https://github.com/AgusRdz/agusrdz-github-api) to review how the API is consumed and this one(https://github.com/AgusRdz/github-api-demo) to see it fully functional.

At ClickIT we are dedicated to creating intelligent solutions that give our customers the security of their applications with the minimum effort using packages like this, whether public or private.