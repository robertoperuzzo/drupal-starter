# Drupal 8 project starter kit

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

### With Platform.sh
1. Clone this repository `git clone git@github.com:robertoperuzzo/drupal8-starter.git your-project-name`.
2. Run `cd your-project-name`
3. Run `platform build`. For more details [Platform.sh CLI](https://docs.platform.sh/gettingstarted/cli.html).
4. Download Docker and run it. If your are a MacOSx user, download Docker from [Edge Channel](https://docs.docker.com/docker-for-mac/install/#download-docker-for-mac)
and uncomment `- ./:/var/www/html:delegated # With Docker Edge version` rows in your `docker-compose.yml``.  
See also [Performance tuning for volume mounts ](https://docs.docker.com/docker-for-mac/osxfs-caching/#performance-implications-of-host-container-file-system-consistency)
5. Setup your local database setting adding this code snippet in ``.platform/local/shared/settings.local.php`` file:
   ```
   $databases['default']['default'] = array (
     'database' => 'drupal',
     'username' => 'drupal',
     'password' => 'drupal',
     'prefix' => '',
     'host' => 'mariadb',
     'port' => '3306',
     'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
     'driver' => 'mysql',
   );
   ```
6. Run `make up` from your shell to build up your docker containers.
7. Open [http://drupal.docker.localhost:8000/](http://drupal.docker.localhost:8000/) in your browser.
8. Enjoy your brand new Drupal 8 website!

## Without Platform.sh
1. Clone this repository `git clone git@github.com:robertoperuzzo/drupal8-starter.git your-project-name`.
2. Run `cd your-project-name`
3. Run `platform build`. For more details [Platform.sh CLI](https://docs.platform.sh/gettingstarted/cli.html).
4. Download Docker and run it. If your are a MacOSx user, download Docker from [Edge Channel](https://docs.docker.com/docker-for-mac/install/#download-docker-for-mac)
and uncomment `- ./:/var/www/html:delegated # With Docker Edge version` rows in your `docker-compose.yml``.  
See also [Performance tuning for volume mounts ](https://docs.docker.com/docker-for-mac/osxfs-caching/#performance-implications-of-host-container-file-system-consistency)
5. Setup your local database setting adding this code snippet in ``.platform/local/shared/settings.local.php`` file:
   ```
   $databases['default']['default'] = array (
     'database' => 'drupal',
     'username' => 'drupal',
     'password' => 'drupal',
     'prefix' => '',
     'host' => 'mariadb',
     'port' => '3306',
     'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
     'driver' => 'mysql',
   );
   ```
6. Run `composer install`. If you don't have *composer* installed, follow this [tutorial](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx).
7. Edit `.env` file setting project variables `PROJECT_NAME` and `PROJECT_BASE_URL 
8. Run `make up` from your shell to build up your docker containers.
7. Open [http://drupal.docker.localhost:8000/](http://drupal.docker.localhost:8000/) in your browser.
8. Enjoy your brand new Drupal 8 website!

## Updating Remotes
You'll need to update your git remotes to reflect that you won't be pushing to github.com with your project’s code. 
You should rename the original origin remote (the github.com [Drupal 8 project template](https://github.com/robertoperuzzo/drupal8-starter) repository) 
to 'starter' and create a new origin pointed at your bare repository.

(On your local development environment)

```
git remote rename origin starter
git remote add origin path/to/your/central/git/repo
```

To see a list of your remote repositories, run the command:

```
git remote
```

For a more detailed listing that includes the remote repositories' URLs, add a -v flag (for verbose) to the end of the command:

```
git remote -v
```

## Contrib Modules

This starter kit contains the following contrib modules dependencies:

| Module name                                                                       | Package                        | 
| --------------------------------------------------------------------------------- | ------------------------------ | 
| [Admin Toolbar](https://www.drupal.org/project/admin_toolbar)                     | drupal/admin_toolbar           |
| [Adminimal Admin Toolbar](https://www.drupal.org/project/adminimal_admin_toolbar) | drupal/adminimal_admin_toolbar |
| [Adminimal Theme](https://www.drupal.org/project/adminimal_theme)                 | drupal/adminimal_theme         |
| [Bootstrap](https://www.drupal.org/project/bootstrap)                             | drupal/bootstrap               | 
| [Chaos tool suite (ctools)](https://www.drupal.org/project/ctools)                | drupal/ctools                  |
| [Config Filter](https://www.drupal.org/project/config_filter)                     | drupal/config_filter           |
| [Config Ignore](https://www.drupal.org/project/config_ignore)                     | drupal/config_ignore           |
| [Config installer](https://www.drupal.org/project/config_installer)               | drupal/config_installer        |
| [Configuration Split](https://www.drupal.org/project/config_split)                | drupal/config_split            |
| [Google Analytics](https://www.drupal.org/project/google_analytics)               | drupal/google_analytics        |
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
| [Captcha](https://www.drupal.org/project/captcha)                                 | drupal/captcha                 |
| [ReCaptcha](https://www.drupal.org/project/recaptcha)                             | drupal/recaptcha               |
| [Permissions filter](https://www.drupal.org/project/permissions_filter)           | drupal/permissions_filter      |
