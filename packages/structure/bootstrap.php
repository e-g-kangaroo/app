<?php

Autoloader::add_namespace('Structure', realpath(__DIR__.'/classes').DIRECTORY_SEPARATOR);

Config::load('structure', true);