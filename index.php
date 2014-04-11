<?php
# Bootstrap
define('ACE_INSTALL_PATH', dirname(__FILE__));
define('ACE_SITE_PATH', ACE_INSTALL_PATH . '/site');
require(ACE_INSTALL_PATH.'/src/CAce/bootstrap.php');

$ace = CAce::Instance();

# Front controller
$ace->FrontControllerRoute();

# Theme engine
$ace->ThemeEngineRender();