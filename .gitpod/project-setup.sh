#!/usr/bin/env bash

# Prepare Drupal website
if [ ! -d ./web/sites/default/files/translations ] ; then
  mkdir ./web/sites/default/files/translations
fi
ddev build
