# Drupal 8 project template

This project provides a starter kit for Drupal 8 projects mixing [Drupal project template for Platform.sh](https://github.com/platformsh/platformsh-example-drupal8) and
 [Docker-based Drupal stack](https://github.com/wodby/docker4drupal) for local development environment. 

## Using as a reference

You can use this repository as a reference for your own Drupal projects, and borrow whatever code is needed. 

If you host you project on Platform.sh, I invite you to read complete informations from [Drupal project template for Platform.sh](https://github.com/platformsh/platformsh-example-drupal8) page. 

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
4. Setup your local database setting adding this code snippet in ``.platform/local/shared/settings.local.php`` file:
   ```
   $databases['default']['default'] = array(
     'driver' => 'mysql',
     'host' => 'mariadb',
     'username' => 'drupal',
     'password' => 'drupal',
     'database' => 'drupal',
     'prefix' => '',
   );
   ```
5. Run `docker-compose up -d` from your shell.
6. Open [http://drupal.docker.localhost:8000/](http://drupal.docker.localhost:8000/) in your browser.
7. Enjoy your brand new Drupal 8 website!

## Contrib Modules

This starter kit contains the following contrib modules dependencies:

| Module name                                                         | Package                 | Version | 
| ------------------------------------------------------------------- | ----------------------- | ------- | 
| [Bootstrap](https://www.drupal.org/project/bootstrap)               | drupal/bootstrap        | 3.10.0  | 
| ------------------------------------------------------------------- | ----------------------- | ------- |
| [Chaos tool suite (ctools)](https://www.drupal.org/project/ctools)  | drupal/ctools           | 3.0.0   |
| ------------------------------------------------------------------- | ----------------------- | ------- |
| [Google Analytics](https://www.drupal.org/project/google_analytics) | drupal/google_analytics | 2.2.0   |
| ------------------------------------------------------------------- | ----------------------- | ------- |
| [Metatag](https://www.drupal.org/project/metatag)                   | drupal/metatag          | 1.4.0   |
| ------------------------------------------------------------------- | ----------------------- | ------- |
| [Pathauto](https://www.drupal.org/project/pathauto)                 | drupal/pathauto         | 1.1.0   |
| ------------------------------------------------------------------- | ----------------------- | ------- |
| [Redirect](https://www.drupal.org/project/redirect)                 | drupal/redirect         | 1.0.0   |
| ------------------------------------------------------------------- | ----------------------- | ------- |
| [Reroute Email](https://www.drupal.org/project/reroute_email)       | drupal/reroute_email    | 1.0.0   |
| ------------------------------------------------------------------- | ----------------------- | ------- |
| [Simple XML sitemap](https://www.drupal.org/project/simple_sitemap) | drupal/simple_sitemap   | 2.11.0  |
| ------------------------------------------------------------------- | ----------------------- | ------- |
| [Sitemap](https://www.drupal.org/project/sitemap)                   | drupal/sitemap          | 1.3.0   |
| ------------------------------------------------------------------- | ----------------------- | ------- |
| [Token](https://www.drupal.org/project/token)                       | drupal/token            | 1.1.0   |