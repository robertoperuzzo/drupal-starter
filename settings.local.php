<?php
// Docker database container setting.
$databases['default']['default'] = [
  'database' => 'drupal',
  'username' => 'drupal',
  'password' => 'drupal',
  'prefix' => '',
  'host' => 'mariadb',
  'port' => '3306',
  'namespace' => 'Drupal\Core\Database\Driver\mysql',
  'driver' => 'mysql',
];

// Configure config split directory
$config['config_split.config_split.blacklist']['status'] = TRUE;
$config['config_split.config_split.dev']['status'] = TRUE;
$config['config_split.config_split.stage']['status'] = TRUE;
$config['config_split.config_split.config_live']['status'] = FALSE;

// Trusted hosts.
$settings['trusted_host_patterns'] = [
  '^drupal\.docker\.localhost$',
];
