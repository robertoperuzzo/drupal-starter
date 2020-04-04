<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{

  /**
   * Set up the local dev environment ready to start working on.
   */
  public function build() {
    /*
     * @todo
     *  - check if containers are already running.
     *  - if task fails stop running next tasks.
     */

    // Drupal init.
    $this->taskExecStack()
      ->stopOnFail()
      ->exec('drupal init --destination=/var/www/html/console/ --no-interaction')
      ->run();

    // Local settings.
    $this->taskFilesystemStack()
      ->stopOnFail()
      ->chmod('web/sites/default', 0755)
      ->symlink('../../../settings.local.php', 'web/sites/default/settings.local.php')
      ->chmod('web/sites/default', 0555)
      ->run();

    // Drupal install.
    $this->taskExecStack()
      ->stopOnFail()
      ->exec('drupal site:install --force --no-interaction')
      ->exec('drush cr')
      ->run();

    // Remove database settings from settings.php.
    $this->taskFilesystemStack()
      ->chmod('web/sites/default/settings.php', 0644)
      ->run();
    $this->taskReplaceInFile('web/sites/default/settings.php')
      ->regex('/\$databases\[([.\S\s]*)\);/i')
      ->to('')
      ->run();
    $this->taskFilesystemStack()
      ->chmod('web/sites/default/settings.php', 0444)
      ->run();



    // Import configuration
//    $this->taskExecStack()
//      ->stopOnFail()
//      //->exec('make drush cset system.site uuid 71b4bfb2-b7eb-4a4b-b513-98cf42d112be')
//      //->exec('docker-compose exec --user 82 php drupal config:import --no-interaction')
//      //->exec('make drush "drush ev \'\Drupal::entityManager()->getStorage(\"shortcut_set\")->load(\"default\")->delete();\'"')
//      //->exec('make drush "cim -y"')
//      ->run();
  }

  /**
   * Clean local environment.
   */
  public function prune() {

    // Drop tables form database and remove docker containers.
    $this->taskExecStack()
      ->stopOnFail()
      ->exec('make drush "sql-drop -y"')
      ->exec('make prune')
      ->run();

    // Remove settings.local.php symbolic link.
    $this->taskFilesystemStack()
      ->stopOnFail()
      ->chmod('web/sites/default', 0755)
      ->remove('web/sites/default/settings.local.php')
      ->chmod('web/sites/default', 0555)
      ->run();
  }

  /**
   * Drupal core update.
   *
   * @command core-update
   */
  public function drupalCoreUpdate() {
    $this->taskExecStack()
      ->stopOnFail()
      ->exec('docker-compose exec --user 82 php composer update drupal/core --with-dependencies')
      ->exec('docker-compose exec --user 82 php drush updatedb -y')
      ->exec('docker-compose exec --user 82 php drush cr')
      ->run();
  }

}