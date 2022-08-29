# Project name

> Ex. The project contains the company's website.

![Repository](https://img.shields.io/badge/Repository-github-blue)
![LAMP](https://img.shields.io/badge/LAMP-Docker-blue)
![Software](https://img.shields.io/badge/Software-Drupal9-blue)

## Using as a reference

You can use this repository as a reference for your own Drupal projects, and borrow whatever you need.

If you are using Platform.sh, I invite you to read further informations on [Drupal project template for Platform.sh](https://github.com/platformsh/platformsh-example-drupal8) page.

## Managing a Drupal site built with Composer

Nothing is easier than managing a Composer-based Drupal site on Platform.sh.
See [Drupal 8 and Composer](https://docs.platform.sh/frameworks/drupal8.html) for details.
For example adding a single module to your Drupal installation is as simple as:

```sh
composer require drupal/devel
git commit -am 'Add the Devel module'
git push
```

## How does this starter kit differ from vanilla Drupal in Drupal.org?

1. There are some differences documented on [Drupal project template for Platform.sh](https://github.com/platformsh/platformsh-example-drupal8#how-does-this-starter-kit-differ-from-vanilla-drupal-from-drupalorg).
2. We added `wodby.yml` in order to use in case [Wodby](https://wodby.com/) infrastructure.
3. We added DDEV configuration in `.ddev` folder.

## Starting your local environment

First of all you need [Docker](https://www.docker.com/get-started) and [DDEV](https://ddev.com/get-started/).

### 1. Clone the project

Clone this repository wherever you want

    git clone git@....  [project-folder-name]
    cd [project-folder-name]

### 2. Build

Start local environment and install drupal from scratch using the current configurations

    ddev build

## Environment management commands

Here some useful commands to manage your local environment.

### Local deployment

When you download new code (`git pull` from repository) you need to run
the following commands in order to sync your local environment:

    ddev composer install --prefer-dist
    ddev robo scaffold
    ddev robo deploy

### Export/import configuration

When you change some configuration you have to run:

    ddev robo config:export

If you need to sync your local configuration you have to run:

    ddev robo config:import

### Export/import database

If you need to export the database dump you have to run:

    ddev robo database:export

If you need to import the database dump you have to run:

    ddev robo database:import [/path/of/dump.sql]

## Contrib Modules

This starter kit contains the following contrib modules dependencies:

| Module name                                                                       | Package                        |
| --------------------------------------------------------------------------------- | ------------------------------ |
| [Admin Toolbar](https://www.drupal.org/project/admin_toolbar)                     | drupal/admin_toolbar           |
| [Chaos tool suite (ctools)](https://www.drupal.org/project/ctools)                | drupal/ctools                  |
| [Config Filter](https://www.drupal.org/project/config_filter)                     | drupal/config_filter           |
| [Config Ignore](https://www.drupal.org/project/config_ignore)                     | drupal/config_ignore           |
| [Configuration Split](https://www.drupal.org/project/config_split)                | drupal/config_split            |
| [Mail System](https://www.drupal.org/project/mailsystem)                          | drupal/mailsystem              |
| [Metatag](https://www.drupal.org/project/metatag)                                 | drupal/metatag                 |
| [Monolog](https://www.drupal.org/project/monolog)                                 | drupal/monolog                 |
| [Pathauto](https://www.drupal.org/project/pathauto)                               | drupal/pathauto                |
| [Redirect](https://www.drupal.org/project/redirect)                               | drupal/redirect                |
| [Reroute Email](https://www.drupal.org/project/reroute_email)                     | drupal/reroute_email           |
| [Simple XML sitemap](https://www.drupal.org/project/simple_sitemap)               | drupal/simple_sitemap          |
| [Sitemap](https://www.drupal.org/project/sitemap)                                 | drupal/sitemap                 |
| [Stage file proxy](https://www.drupal.org/project/stage_file_proxy)               | drupal/stage_file_proxy        |
| [Token](https://www.drupal.org/project/token)                                     | drupal/token                   |
| [Twig Tweak](https://www.drupal.org/project/twig_tweak)                           | drupal/twig_tweak              |
| [Permissions filter](https://www.drupal.org/project/permissions_filter)           | drupal/permissions_filter      |
