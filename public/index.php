<?php

chdir(dirname(__DIR__));

// Setup autoloading
include 'autoloading.php';

// Run the application!
Zend\Mvc\Application::init(include 'config/application.config.php')->run()->send();
