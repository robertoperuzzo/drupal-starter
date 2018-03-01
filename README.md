# Drupal 8 project template

This project provides a starter kit for Drupal 8 projects mixing [Drupal project template for Platform.sh](https://github.com/platformsh/platformsh-example-drupal8) and
 [Docker-based Drupal stack](https://github.com/wodby/docker4drupal) for local development environment. 

## Using as a reference

You can use this repository as a reference for your own Drupal projects, and borrow whatever code is needed. 

If you host you project on Platform.sh, the most important parts are the [`.platform.app.yaml`](/.platform.app.yaml) 
file and the [`.platform`](/.platform) directory. 

Also see:

* [`settings.php`](/web/sites/default/settings.php) - The customized `settings.php` file works for both Platform.sh 
and local development, setting only those values that are needed in both.  You can add additional values as 
documented in `default.settings.php` as desired.
* [`settings.platformsh.php`](/web/sites/default/settings.platformsh.php) - This file contains Platform.sh-specific 
code to map environment variables into Drupal configuration.  You can add to it as needed. 
See [the documentation](https://docs.platform.sh/frameworks/drupal8.html) for more examples of common snippets to include here.
* [`scripts/platformsh`](/scripts/platformsh) - This directory contains our update script to keep this repository 
in sync with the Drupal Composer project.  It may be safely ignored or removed.

## Managing a Drupal site built with Composer

Nothing is easier than managing a Composer-based Drupal site on Platform.sh. 
See [Drupal 8 and Composer](https://docs.platform.sh/frameworks/drupal8.html) for details. 
For example adding a single module to your Drupal installation is as simple as:

```sh
composer require drupal/devel
git commit -am 'Add the Devel module'
git push
```

## How does this starter kit differ from vanilla Drupal from Drupal.org?

1. There are some differences documented on [Drupal project template for Platform.sh](https://github.com/platformsh/platformsh-example-drupal8#how-does-this-starter-kit-differ-from-vanilla-drupal-from-drupalorg).
2. We include [`docker-compose.yml`](https://github.com/robertoperuzzo/drupal8-starter/blob/master/docker-compose.yml) file
to run useful docker containers for local development environment as described here [Docker-based Drupal stack](https://github.com/wodby/docker4drupal).
You are free to tweak it as needed for your particular environment.
sSee also [Docker Compose](https://docs.docker.com/compose/).

## Starting your local environment

To start your new project, you can follow the steps below:

1. Clone this repository `git clone git@github.com:robertoperuzzo/drupal8-starter.git`.
2. Run `platform build`. For more details [Platform.sh CLI](https://docs.platform.sh/gettingstarted/cli.html).
3. Download Docker and run it. If your are a MacOSx user, download Docker from [Edge Channel](https://docs.docker.com/docker-for-mac/install/#download-docker-for-mac)
and uncomment `- ./:/var/www/html:delegated # With Docker Edge version` rows in your `docker-compose.yml``.  
See also [Performance tuning for volume mounts ](https://docs.docker.com/docker-for-mac/osxfs-caching/#performance-implications-of-host-container-file-system-consistency)
4. Run `docker-compose up -d`.
5. Open [http://drupal.docker.localhost:8000/](http://drupal.docker.localhost:8000/) in your browser.
6. Enjoy your brand new Drupal 8 website!
