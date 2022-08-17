<?php

use Drupal\Core\DrupalKernel;

$autoloader = include_once 'autoload.php';

$kernel = new DrupalKernel('prod', $autoloader);
$kernel->loadLegacyIncludes();
$kernel->bootEnvironment();

// Core modules.
$autoloader->addPsr4('Drupal\\taxonomy\\', 'web/core/modules/taxonomy/src');
$autoloader->addPsr4('Drupal\\path_alias\\', 'web/core/modules/path_alias/src');
$autoloader->addPsr4('Drupal\\views\\', 'web/core/modules/views/src');

// Non class files.
// require('web/core/modules/user/user.module');
